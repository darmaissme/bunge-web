<?php

namespace Database\Seeders;

use App\Models\ConsultationSlot;
use App\Models\EventDate;
use Illuminate\Database\Seeder;

class EventDateSeeder extends Seeder
{
    /**
     * Seed initial event dates and 12 daily 30-minute consultation slots.
     */
    public function run(): void
    {
        $dates = [
            '2026-09-16',
            '2026-09-17',
            '2026-09-18',
        ];

        $timeSlots = [
            ['start' => '11:00', 'end' => '11:30'],
            ['start' => '11:30', 'end' => '12:00'],
            ['start' => '12:00', 'end' => '12:30'],
            ['start' => '12:30', 'end' => '13:00'],
            ['start' => '13:00', 'end' => '13:30'],
            ['start' => '13:30', 'end' => '14:00'],
            ['start' => '14:00', 'end' => '14:30'],
            ['start' => '14:30', 'end' => '15:00'],
            ['start' => '15:00', 'end' => '15:30'],
            ['start' => '15:30', 'end' => '16:00'],
            ['start' => '16:00', 'end' => '16:30'],
            ['start' => '16:30', 'end' => '17:00'],
        ];

        foreach ($dates as $dateString) {
            $eventDate = EventDate::firstOrCreate(
                ['date' => $dateString],
                [
                    'is_active' => true,
                    'capacity' => 36,
                ]
            );

            foreach ($timeSlots as $slot) {
                ConsultationSlot::firstOrCreate(
                    [
                        'event_date_id' => $eventDate->id,
                        'start_time' => $slot['start'],
                    ],
                    [
                        'end_time' => $slot['end'],
                        'capacity' => 3,
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
