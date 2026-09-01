<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConsultationSlot extends Model
{
    use HasFactory;

    protected $table = 'consultation_slots';

    protected $fillable = [
        'event_date_id',
        'start_time',
        'end_time',
        'capacity',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'capacity' => 'integer',
    ];

    /**
     * Parent event date.
     */
    public function eventDate(): BelongsTo
    {
        return $this->belongsTo(EventDate::class, 'event_date_id');
    }

    /**
     * Consultations booked for this slot.
     */
    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class, 'consultation_slot_id');
    }

    /**
     * Calculate count of active occupied bookings for this slot.
     * Note: 'confirmed', 'pending', and 'completed' consume capacity.
     * 'cancelled' does NOT consume capacity.
     */
    public function getOccupiedCountAttribute(): int
    {
        return $this->consultations()
            ->whereIn('status', ['confirmed', 'pending', 'completed'])
            ->count();
    }

    /**
     * Calculate remaining available positions.
     */
    public function getAvailableCountAttribute(): int
    {
        return max(0, $this->capacity - $this->occupied_count);
    }

    /**
     * Determine if this slot is full.
     */
    public function getIsFullAttribute(): bool
    {
        return $this->available_count <= 0;
    }

    /**
     * Formatted time range (e.g. 11:00 – 11:30 WIB).
     */
    public function getFormattedTimeRangeAttribute(): string
    {
        return "{$this->start_time} – {$this->end_time} WIB";
    }
}
