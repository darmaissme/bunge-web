<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventDate extends Model
{
    use HasFactory;

    protected $table = 'event_dates';

    protected $fillable = [
        'date',
        'is_active',
        'capacity',
    ];

    protected $casts = [
        'date' => 'date',
        'is_active' => 'boolean',
        'capacity' => 'integer',
    ];

    /**
     * Get all consultation slots for this date.
     */
    public function slots(): HasMany
    {
        return $this->hasMany(ConsultationSlot::class, 'event_date_id')->orderBy('start_time', 'asc');
    }

    /**
     * Get all consultations for this date.
     */
    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class, 'event_date_id');
    }

    /**
     * Get human readable formatted date (e.g. 16 September 2026).
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->date ? $this->date->format('d F Y') : '';
    }

    /**
     * Calculate total occupied bookings across all slots for this date.
     */
    public function getOccupiedBookingsCountAttribute(): int
    {
        return $this->consultations()
            ->whereIn('status', ['confirmed', 'pending', 'completed'])
            ->count();
    }

    /**
     * Check if all slots for this date are full.
     */
    public function getIsFullAttribute(): bool
    {
        if (! $this->is_active) {
            return true;
        }

        $activeSlots = $this->slots()->where('is_active', true)->get();
        if ($activeSlots->isEmpty()) {
            return true;
        }

        foreach ($activeSlots as $slot) {
            if (! $slot->is_full) {
                return false;
            }
        }

        return true;
    }
}
