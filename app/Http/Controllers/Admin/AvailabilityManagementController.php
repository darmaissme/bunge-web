<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\ConsultationSlot;
use App\Models\EventDate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AvailabilityManagementController extends Controller
{
    /**
     * Display Admin Availability Monitor with event dates and real-time 12-slot occupancy.
     */
    public function index(Request $request): View
    {
        $eventDates = EventDate::with(['slots' => function ($q) {
            $q->orderBy('start_time', 'asc')
              ->withCount(['consultations as occupied_count' => function ($query) {
                  $query->whereIn('status', ['confirmed', 'pending', 'completed']);
              }]);
        }])->orderBy('date', 'asc')->get();

        return view('admin.availability.index', compact('eventDates'));
    }

    /**
     * Toggle active state for an EventDate.
     */
    public function toggleDate(EventDate $eventDate): RedirectResponse
    {
        // If deactivating date, check if active bookings exist
        if ($eventDate->is_active) {
            $activeBookings = Consultation::where('event_date_id', $eventDate->id)
                ->whereIn('status', ['confirmed', 'pending', 'completed'])
                ->count();

            if ($activeBookings > 0) {
                return back()->with('error', "Cannot deactivate date {$eventDate->formatted_date} because it currently has {$activeBookings} active booking(s).");
            }
        }

        $eventDate->update(['is_active' => ! $eventDate->is_active]);

        $statusLabel = $eventDate->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "Event date {$eventDate->formatted_date} has been {$statusLabel}.");
    }

    /**
     * Toggle active state for a ConsultationSlot.
     */
    public function toggleSlot(ConsultationSlot $slot): RedirectResponse
    {
        if ($slot->is_active) {
            $activeBookings = Consultation::where('consultation_slot_id', $slot->id)
                ->whereIn('status', ['confirmed', 'pending', 'completed'])
                ->count();

            if ($activeBookings > 0) {
                return back()->with('error', "Cannot deactivate slot {$slot->formatted_time_range} because it currently has {$activeBookings} active booking(s).");
            }
        }

        $slot->update(['is_active' => ! $slot->is_active]);

        $statusLabel = $slot->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "Time slot {$slot->formatted_time_range} has been {$statusLabel}.");
    }
}
