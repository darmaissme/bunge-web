<?php

namespace App\Http\Controllers;

use App\Models\ConsultationSlot;
use App\Models\EventDate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    /**
     * Get active event dates and their overall availability status.
     */
    public function getEventDates(): JsonResponse
    {
        $eventDates = EventDate::where('is_active', true)
            ->orderBy('date', 'asc')
            ->get();

        $data = $eventDates->map(function ($eventDate) {
            $occupied = $eventDate->occupied_bookings_count;
            $available = max(0, $eventDate->capacity - $occupied);

            return [
                'id' => $eventDate->id,
                'date' => $eventDate->date->format('Y-m-d'),
                'formatted_date' => $eventDate->formatted_date,
                'capacity' => $eventDate->capacity,
                'occupied' => $occupied,
                'available' => $available,
                'is_full' => $eventDate->is_full,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    /**
     * Get 12 consultation slots and real-time availability for a given date.
     */
    public function getAvailability(Request $request): JsonResponse
    {
        $dateParam = $request->query('date');

        if (! $dateParam) {
            return response()->json([
                'error' => 'Date parameter is required',
            ], 422);
        }

        $eventDate = EventDate::where('is_active', true)
            ->where(function ($q) use ($dateParam) {
                if (is_numeric($dateParam)) {
                    $q->where('id', $dateParam);
                } else {
                    $q->where('date', $dateParam);
                }
            })
            ->first();

        if (! $eventDate) {
            return response()->json([
                'error' => 'Selected date is not an active event date',
            ], 404);
        }

        // Efficiently eager-load slots with consultations count filtered by active statuses
        $slots = ConsultationSlot::where('event_date_id', $eventDate->id)
            ->where('is_active', true)
            ->orderBy('start_time', 'asc')
            ->withCount(['consultations as occupied_count' => function ($query) {
                $query->whereIn('status', ['confirmed', 'pending', 'completed']);
            }])
            ->get();

        $formattedSlots = $slots->map(function ($slot) {
            $booked = (int) $slot->occupied_count;
            $available = max(0, (int) $slot->capacity - $booked);
            $isFull = $available <= 0;

            return [
                'id' => $slot->id,
                'start_time' => $slot->start_time,
                'end_time' => $slot->end_time,
                'formatted_time' => $slot->formatted_time_range,
                'capacity' => (int) $slot->capacity,
                'booked' => $booked,
                'available' => $available,
                'is_full' => $isFull,
                'is_active' => (bool) $slot->is_active,
            ];
        });

        return response()->json([
            'date' => $eventDate->date->format('Y-m-d'),
            'event_date_id' => $eventDate->id,
            'timezone' => 'Asia/Jakarta',
            'is_full' => $eventDate->is_full,
            'slots' => $formattedSlots,
        ]);
    }
}
