<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultationRequest;
use App\Models\Consultation;
use App\Models\ConsultationSlot;
use App\Models\EventDate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConsultationController extends Controller
{
    /**
     * Handle incoming consultation form submission with strict capacity validation & transaction locking.
     */
    public function store(StoreConsultationRequest $request)
    {
        try {
            // Anti-Spam Honeypot Guard: reject bot submissions silently
            if (! empty($request->input('bunge_website_hp'))) {
                return response()->json([
                    'success' => true,
                    'message' => 'Booking received.',
                    'redirect' => url('/'),
                ]);
            }

            $email = trim($request->input('email'));
            $phone = trim($request->input('phone'));

            // Pre-transaction validation check for clean error messages
            $dupCheck = Consultation::checkDuplicateActiveBooking($email, $phone);
            if ($dupCheck['is_duplicate']) {
                $errors = [];
                if ($dupCheck['email_duplicate'] && $dupCheck['phone_duplicate']) {
                    $errors['email'] = 'You already have an active consultation booking.';
                    $errors['phone'] = 'You already have an active consultation booking.';
                } elseif ($dupCheck['email_duplicate']) {
                    $errors['email'] = 'An active consultation booking already exists for this email address.';
                } else {
                    $errors['phone'] = 'An active consultation booking already exists for this phone number.';
                }

                throw ValidationException::withMessages($errors)->redirectTo(url('/#consultation'));
            }

            $rawSlotId = $request->input('consultation_slot_id');
            $rawEventDateId = $request->input('event_date_id');

            $slotId = (! empty($rawSlotId) && is_numeric($rawSlotId)) ? (int) $rawSlotId : null;
            $eventDateId = (! empty($rawEventDateId) && is_numeric($rawEventDateId)) ? (int) $rawEventDateId : null;

            $preferredDate = $request->input('preferred_date');
            $preferredTime = $request->input('preferred_time');
            $notes = ! empty($request->input('notes')) ? $request->input('notes') : null;

            // Execute inside database transaction with row locking
            $consultation = DB::transaction(function () use ($request, $email, $phone, &$slotId, &$eventDateId, $preferredDate, $preferredTime, $notes) {

                // Atomic re-check inside transaction with lockForUpdate to protect against race conditions
                $txDupCheck = Consultation::checkDuplicateActiveBooking($email, $phone, null, true);
                if ($txDupCheck['is_duplicate']) {
                    $errors = [];
                    if ($txDupCheck['email_duplicate'] && $txDupCheck['phone_duplicate']) {
                        $errors['email'] = 'You already have an active consultation booking.';
                        $errors['phone'] = 'You already have an active consultation booking.';
                    } elseif ($txDupCheck['email_duplicate']) {
                        $errors['email'] = 'An active consultation booking already exists for this email address.';
                    } else {
                        $errors['phone'] = 'An active consultation booking already exists for this phone number.';
                    }

                    throw ValidationException::withMessages($errors)->redirectTo(url('/#consultation'));
                }

                $resolvedSlot = null;

                // If slotId passed, validate slot belongs to event date and check capacity with row lock
                if ($slotId) {
                    $resolvedSlot = ConsultationSlot::where('id', $slotId)
                        ->lockForUpdate()
                        ->first();

                    if (! $resolvedSlot || ! $resolvedSlot->is_active) {
                        throw ValidationException::withMessages([
                            'preferred_time' => 'Selected consultation slot is inactive or invalid. Please choose another time.',
                        ])->redirectTo(url('/#consultation'));
                    }

                    $eventDateId = (int) $resolvedSlot->event_date_id;

                    $resolvedEventDate = $resolvedSlot->eventDate;
                    if ($resolvedEventDate && ! $resolvedEventDate->is_active) {
                        throw ValidationException::withMessages([
                            'preferred_date' => 'Selected event date is not available. Please choose another date.',
                        ])->redirectTo(url('/#consultation'));
                    }

                    // Check occupied capacity
                    $occupiedCount = Consultation::where('consultation_slot_id', $resolvedSlot->id)
                        ->whereIn('status', ['confirmed', 'pending', 'completed'])
                        ->lockForUpdate()
                        ->count();

                    if ($occupiedCount >= $resolvedSlot->capacity) {
                        throw ValidationException::withMessages([
                            'preferred_time' => 'Sorry, this time slot is no longer available. Please choose another time.',
                        ])->redirectTo(url('/#consultation'));
                    }
                } else {
                    // Fallback lookup by date string & time string if IDs were not sent
                    $matchedEventDate = EventDate::where('date', $preferredDate)->where('is_active', true)->first();
                    if ($matchedEventDate) {
                        $eventDateId = (int) $matchedEventDate->id;
                        $matchedSlot = ConsultationSlot::where('event_date_id', $matchedEventDate->id)
                            ->where('start_time', 'LIKE', substr($preferredTime, 0, 5) . '%')
                            ->lockForUpdate()
                            ->first();

                        if ($matchedSlot) {
                            $slotId = (int) $matchedSlot->id;
                            $occupiedCount = Consultation::where('consultation_slot_id', $matchedSlot->id)
                                ->whereIn('status', ['confirmed', 'pending', 'completed'])
                                ->lockForUpdate()
                                ->count();

                            if ($occupiedCount >= $matchedSlot->capacity) {
                                throw ValidationException::withMessages([
                                    'preferred_time' => 'Sorry, this time slot is no longer available. Please choose another time.',
                                ])->redirectTo(url('/#consultation'));
                            }
                        }
                    }
                }

                $bookingNumber = Consultation::generateUniqueBookingNumber();

                return Consultation::create([
                    'booking_number' => $bookingNumber,
                    'full_name' => trim($request->input('full_name')),
                    'phone' => trim($request->input('phone')),
                    'email' => trim($request->input('email')),
                    'company' => trim($request->input('company')),
                    'industry' => $request->input('industry'),
                    'discussion_topic' => $request->input('discussion_topic'),
                    'event_date_id' => $eventDateId ? (int) $eventDateId : null,
                    'consultation_slot_id' => $slotId ? (int) $slotId : null,
                    'preferred_date' => $preferredDate,
                    'preferred_time' => $preferredTime,
                    'notes' => $notes,
                    'specialist' => 'To be assigned',
                    'duration' => '30 Menit',
                    'status' => 'confirmed',
                ]);
            });

            session(['managed_booking_' . $consultation->booking_number => true]);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'booking_number' => $consultation->booking_number,
                    'redirect' => route('ticket.show', ['booking_number' => $consultation->booking_number]),
                ]);
            }

            return redirect()->route('ticket.show', [
                'booking_number' => $consultation->booking_number,
            ]);
        } catch (ValidationException $ve) {
            throw $ve;
        } catch (\Throwable $e) {
            if (function_exists('logger')) {
                logger()->error('Consultation store error: ' . $e->getMessage(), ['exception' => $e]);
            }
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while creating your booking. Please try again.',
                ], 500);
            }
            throw $e;
        }
    }

    /**
     * Perform public visitor booking lookup using Booking Number + Email Address.
     */
    public function manageLookup(\Illuminate\Http\Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'booking_number' => ['required', 'string'],
            'email' => ['required', 'email'],
        ]);

        $rawBookingNumber = strtoupper(trim($request->input('booking_number')));
        $normalizedEmail = Consultation::normalizeEmail($request->input('email'));

        $booking = Consultation::where('booking_number', $rawBookingNumber)->first();

        // Security check: Both booking number AND email must match the SAME consultation record
        if (! $booking || Consultation::normalizeEmail($booking->email) !== $normalizedEmail) {
            return response()->json([
                'success' => false,
                'message' => "We couldn't find a booking matching those details.",
            ], 404);
        }

        // Grant secure session token for this specific booking
        session(['managed_booking_' . $booking->booking_number => true]);

        return response()->json([
            'success' => true,
            'booking_number' => $booking->booking_number,
            'redirect' => route('ticket.show', ['booking_number' => $booking->booking_number]),
        ]);
    }

    /**
     * Display ticket confirmation page for a given booking number.
     */
    public function show(string $booking_number): View
    {
        $booking = Consultation::where('booking_number', $booking_number)->firstOrFail();

        // Security verification check
        $isVerified = session('managed_booking_' . $booking->booking_number, false);

        return view('ticket', compact('booking', 'isVerified'));
    }

    /**
     * Download native server-side PDF ticket pass for a given booking number.
     */
    public function exportPdf(string $booking_number)
    {
        $booking = Consultation::where('booking_number', $booking_number)->firstOrFail();

        if ($booking->status === 'cancelled') {
            abort(403, 'This booking has been cancelled and PDF pass generation is disabled.');
        }

        $pdfContent = \App\Services\TicketPdfService::generate($booking);
        $filename = "Bunge-FlexiBetter-Ticket-{$booking->booking_number}.pdf";

        return response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Content-Length' => strlen($pdfContent),
            'Cache-Control' => 'private, max-age=0, must-revalidate',
            'Pragma' => 'public',
        ]);
    }

    /**
     * Cancel an existing consultation booking using a database transaction with locking.
     */
    public function cancel(string $booking_number): \Illuminate\Http\JsonResponse
    {
        try {
            $result = DB::transaction(function () use ($booking_number) {
                // Find booking with pessimistic lock to prevent race conditions
                $booking = Consultation::where('booking_number', $booking_number)
                    ->lockForUpdate()
                    ->first();

                if (! $booking) {
                    return [
                        'status' => 404,
                        'data' => [
                            'success' => false,
                            'message' => 'Booking Not Found',
                        ],
                    ];
                }

                // Double-cancellation protection
                if ($booking->status === 'cancelled') {
                    return [
                        'status' => 400,
                        'data' => [
                            'success' => false,
                            'already_cancelled' => true,
                            'message' => 'Booking Already Cancelled',
                        ],
                    ];
                }

                // Completed booking status validation
                if ($booking->status === 'completed') {
                    return [
                        'status' => 400,
                        'data' => [
                            'success' => false,
                            'message' => 'Completed bookings cannot be cancelled.',
                        ],
                    ];
                }

                // Perform cancellation (only updates status to cancelled)
                $booking->status = 'cancelled';
                $booking->save();

                return [
                    'status' => 200,
                    'data' => [
                        'success' => true,
                        'message' => 'Your consultation booking has been successfully cancelled.',
                        'booking' => [
                            'booking_number' => $booking->booking_number,
                            'status' => $booking->status,
                            'formatted_date' => $booking->formatted_preferred_date,
                            'formatted_time' => $booking->formatted_preferred_time,
                        ],
                    ],
                ];
            });

            return response()->json($result['data'], $result['status']);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to cancel booking. Please try again.',
            ], 500);
        }
    }

    /**
     * Reschedule an existing consultation booking using a database transaction with locking.
     */
    public function reschedule(\Illuminate\Http\Request $request, string $booking_number): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'event_date_id' => 'required|integer',
            'consultation_slot_id' => 'required|integer',
            'preferred_date' => 'nullable|string',
            'preferred_time' => 'nullable|string',
        ]);

        $eventDateId = (int) $request->input('event_date_id');
        $slotId = (int) $request->input('consultation_slot_id');

        try {
            $result = DB::transaction(function () use ($booking_number, $eventDateId, $slotId) {
                // Find existing booking with pessimistic lock to prevent race conditions
                $booking = Consultation::where('booking_number', $booking_number)
                    ->lockForUpdate()
                    ->first();

                if (! $booking) {
                    return [
                        'status' => 404,
                        'data' => [
                            'success' => false,
                            'message' => 'Booking Not Found',
                        ],
                    ];
                }

                // Active booking status rules
                if ($booking->status === 'cancelled') {
                    return [
                        'status' => 400,
                        'data' => [
                            'success' => false,
                            'message' => 'This booking has been cancelled and cannot be rescheduled.',
                        ],
                    ];
                }

                if ($booking->status === 'completed') {
                    return [
                        'status' => 400,
                        'data' => [
                            'success' => false,
                            'message' => 'Completed bookings cannot be rescheduled.',
                        ],
                    ];
                }

                if ($booking->status !== 'confirmed') {
                    return [
                        'status' => 400,
                        'data' => [
                            'success' => false,
                            'message' => 'Only active bookings can be rescheduled.',
                        ],
                    ];
                }

                // Lock and validate target consultation slot
                $targetSlot = ConsultationSlot::where('id', $slotId)
                    ->lockForUpdate()
                    ->first();

                if (! $targetSlot || ! $targetSlot->is_active) {
                    return [
                        'status' => 400,
                        'data' => [
                            'success' => false,
                            'message' => 'Selected time slot is invalid or inactive.',
                        ],
                    ];
                }

                // Security check: Verify slot belongs to target event date
                if ((int) $targetSlot->event_date_id !== $eventDateId) {
                    return [
                        'status' => 400,
                        'data' => [
                            'success' => false,
                            'message' => 'Selected time slot does not belong to the selected date.',
                        ],
                    ];
                }

                // Lock and validate target event date
                $targetEventDate = EventDate::where('id', $eventDateId)->first();

                if (! $targetEventDate || ! $targetEventDate->is_active) {
                    return [
                        'status' => 400,
                        'data' => [
                            'success' => false,
                            'message' => 'Selected event date is not available.',
                        ],
                    ];
                }

                // Check if target schedule is identical to current schedule
                if ((int) $booking->event_date_id === $eventDateId && (int) $booking->consultation_slot_id === $slotId) {
                    return [
                        'status' => 200,
                        'data' => [
                            'success' => true,
                            'no_change' => true,
                            'message' => 'This is already your current schedule.',
                        ],
                    ];
                }

                // Capacity check for DIFFERENT target slot with pessimistic row locking
                $occupiedCount = Consultation::where('consultation_slot_id', $targetSlot->id)
                    ->whereIn('status', ['confirmed', 'pending', 'completed'])
                    ->lockForUpdate()
                    ->count();

                if ($occupiedCount >= $targetSlot->capacity) {
                    return [
                        'status' => 400,
                        'data' => [
                            'success' => false,
                            'message' => 'This time slot is no longer available. Please select another time.',
                        ],
                    ];
                }

                // UPDATE SAME CONSULTATION RECORD (Do NOT create new record, keep booking_number and visitor data intact)
                $booking->event_date_id = $targetEventDate->id;
                $booking->consultation_slot_id = $targetSlot->id;
                $booking->preferred_date = $targetEventDate->date->format('Y-m-d');
                $booking->preferred_time = $targetSlot->formatted_time_range;
                $booking->save();

                return [
                    'status' => 200,
                    'data' => [
                        'success' => true,
                        'message' => 'Your consultation schedule has been successfully updated.',
                        'booking' => [
                            'booking_number' => $booking->booking_number,
                            'status' => $booking->status,
                            'formatted_date' => $booking->formatted_preferred_date,
                            'formatted_time' => $booking->formatted_preferred_time,
                        ],
                    ],
                ];
            });

            return response()->json($result['data'], $result['status']);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to update your consultation. Please try again.',
            ], 500);
        }
    }
}
