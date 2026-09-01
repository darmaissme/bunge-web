<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateBookingRequest;
use App\Models\Consultation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BookingController extends Controller
{
    /**
     * Shared reusable filtered query builder for bookings listing and exports.
     */
    protected function getFilteredBookingsQuery(Request $request): Builder
    {
        $query = Consultation::query();

        // Search by booking_number, full_name, email, company, phone
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('booking_number', 'LIKE', "%{$search}%")
                  ->orWhere('full_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('company', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        // Filter by status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Filter by industry
        if ($industry = $request->input('industry')) {
            $query->where('industry', $industry);
        }

        // Filter by preferred_date (supports 16, 17, 18, 2026-09-16, 16 Sept 2026, etc.)
        if ($date = $request->input('preferred_date')) {
            if ($date === '16' || str_contains($date, '16')) {
                $query->where(function ($q) {
                    $q->whereDate('preferred_date', '2026-09-16')
                      ->orWhere('preferred_date', 'LIKE', '%16%');
                });
            } elseif ($date === '17' || str_contains($date, '17')) {
                $query->where(function ($q) {
                    $q->whereDate('preferred_date', '2026-09-17')
                      ->orWhere('preferred_date', 'LIKE', '%17%');
                });
            } elseif ($date === '18' || str_contains($date, '18')) {
                $query->where(function ($q) {
                    $q->whereDate('preferred_date', '2026-09-18')
                      ->orWhere('preferred_date', 'LIKE', '%18%');
                });
            } else {
                $query->where('preferred_date', 'LIKE', "%{$date}%");
            }
        }

        // Filter by specialist
        if ($specialist = $request->input('specialist')) {
            $query->where('specialist', $specialist);
        }

        // Sort Direction: 'desc' = terbaru / newest first (default), 'asc' = terlama / oldest first
        $sort = $request->input('sort', 'desc');
        if ($sort === 'asc') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query;
    }

    /**
     * Display a paginated list of consultations with search and filter capabilities.
     */
    public function index(Request $request): View
    {
        $bookings = $this->getFilteredBookingsQuery($request)
            ->paginate(10)
            ->withQueryString();

        // Distinct options for filter dropdowns
        $industries = Consultation::whereNotNull('industry')->where('industry', '!=', '')->distinct()->pluck('industry');
        $specialists = Consultation::whereNotNull('specialist')->where('specialist', '!=', '')->distinct()->pluck('specialist');

        return view('admin.bookings.index', compact('bookings', 'industries', 'specialists'));
    }

    /**
     * Display detailed booking information.
     */
    public function show(Consultation $booking): View
    {
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Show form to edit booking.
     */
    public function edit(Consultation $booking): View
    {
        return view('admin.bookings.edit', compact('booking'));
    }

    /**
     * Update booking record in database.
     */
    public function update(UpdateBookingRequest $request, Consultation $booking): RedirectResponse
    {
        $data = $request->validated();
        
        // Ensure booking_number cannot be modified
        unset($data['booking_number']);

        $booking->update($data);

        return redirect()
            ->route('admin.bookings.show', $booking)
            ->with('success', "Booking #{$booking->booking_number} updated successfully.");
    }

    /**
     * Export consultations to CSV stream with active filter preservation.
     */
    public function exportCsv(Request $request): StreamedResponse
    {
        $fileName = 'bunge-consultations-' . date('Y-m-d') . '.csv';

        // Use SHARED query logic
        $bookings = $this->getFilteredBookingsQuery($request)->get();

        $headers = [
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename={$fileName}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($bookings) {
            $file = fopen('php://output', 'w');
            
            // UTF-8 BOM for Microsoft Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // CSV Columns Header
            fputcsv($file, [
                'Booking Number',
                'Full Name',
                'Phone',
                'Email',
                'Company',
                'Industry',
                'Discussion Topic',
                'Preferred Date',
                'Preferred Time',
                'Specialist',
                'Duration',
                'Status',
                'Notes',
                'Created At'
            ]);

            foreach ($bookings as $b) {
                fputcsv($file, [
                    $b->booking_number,
                    $b->full_name,
                    $b->phone,
                    $b->email,
                    $b->company,
                    $b->industry,
                    $b->discussion_topic,
                    $b->preferred_date,
                    $b->preferred_time,
                    $b->specialist,
                    $b->duration,
                    $b->status,
                    $b->notes,
                    $b->created_at ? $b->created_at->format('Y-m-d H:i:s') : ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * TYPE 1 — REPORT PDF: Export filtered bookings dataset as A4 Landscape PDF Report.
     */
    public function exportPdf(Request $request): View
    {
        // Use EXACT SAME SHARED query logic as CSV Export
        $bookings = $this->getFilteredBookingsQuery($request)->get();

        $filters = $request->only(['search', 'status', 'industry', 'preferred_date', 'specialist']);

        return view('pdf.booking-report', compact('bookings', 'filters'));
    }

    /**
     * TYPE 2 — INDIVIDUAL TICKET PDF: Render individual ticket pass for a booking.
     */
    public function pdf(Consultation $booking): View
    {
        return view('pdf.booking-ticket', compact('booking'));
    }

    /**
     * Remove the specified consultation booking from storage while preserving active filters.
     */
    public function destroy(Request $request, Consultation $booking): RedirectResponse
    {
        $bookingNumber = $booking->booking_number;
        $booking->delete();

        // Redirect back if referer exists to preserve exact active filter parameters
        if ($request->headers->get('referer')) {
            return redirect()->back()->with('success', "Booking #{$bookingNumber} deleted successfully.");
        }

        return redirect()
            ->route('admin.bookings.index', $request->query())
            ->with('success', "Booking #{$bookingNumber} deleted successfully.");
    }

    /**
     * Reset/Delete ALL consultation bookings and reset slot availability counters.
     */
    public function resetAll(Request $request): RedirectResponse
    {
        // Delete all consultation bookings
        Consultation::truncate();

        // Reset slot availability occupied counters in database if models exist
        if (class_exists(\App\Models\EventDate::class)) {
            \App\Models\EventDate::query()->update(['occupied_bookings_count' => 0]);
        }
        if (class_exists(\App\Models\ConsultationSlot::class)) {
            \App\Models\ConsultationSlot::query()->update(['occupied_bookings_count' => 0, 'is_available' => true]);
        }

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'All booking records and slot availability counters have been successfully reset.');
    }
}
