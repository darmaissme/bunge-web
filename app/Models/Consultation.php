<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Consultation extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'consultations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'booking_number',
        'full_name',
        'phone',
        'email',
        'company',
        'industry',
        'discussion_topic',
        'event_date_id',
        'consultation_slot_id',
        'preferred_date',
        'preferred_time',
        'notes',
        'specialist',
        'duration',
        'status',
    ];

    /**
     * Relationship to EventDate.
     */
    public function eventDate()
    {
        return $this->belongsTo(EventDate::class, 'event_date_id');
    }

    /**
     * Relationship to ConsultationSlot.
     */
    public function consultationSlot()
    {
        return $this->belongsTo(ConsultationSlot::class, 'consultation_slot_id');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'preferred_date' => 'date',
    ];

    /**
     * Get human readable formatted date (e.g. 17 September 2026)
     */
    public function getFormattedPreferredDateAttribute(): string
    {
        return $this->preferred_date ? $this->preferred_date->format('d F Y') : '';
    }

    /**
     * Get human readable formatted time (e.g. 10:00 – 10:30 WIB)
     */
    public function getFormattedPreferredTimeAttribute(): string
    {
        if (empty($this->preferred_time)) {
            return '';
        }

        if (! str_contains(strtoupper($this->preferred_time), 'WIB')) {
            return $this->preferred_time . ' WIB';
        }

        return $this->preferred_time;
    }

    /**
     * Safely generate a unique booking number in the format BNG-FIA26-000001
     */
    public static function generateUniqueBookingNumber(): string
    {
        $prefix = 'BNG-FIA26-';

        // Query the max ID or max existing booking number prefix
        $latestRecord = static::query()
            ->where('booking_number', 'LIKE', $prefix . '%')
            ->orderBy('id', 'desc')
            ->lockForUpdate()
            ->first();

        if (! $latestRecord) {
            $nextSequence = 1;
        } else {
            $lastBookingNumber = $latestRecord->booking_number;
            $sequenceString = str_replace($prefix, '', $lastBookingNumber);
            $nextSequence = (int) $sequenceString + 1;
        }

        $candidate = $prefix . str_pad((string) $nextSequence, 6, '0', STR_PAD_LEFT);

        // Fallback safety loop against potential race condition
        while (static::where('booking_number', $candidate)->exists()) {
            $nextSequence++;
            $candidate = $prefix . str_pad((string) $nextSequence, 6, '0', STR_PAD_LEFT);
        }

        return $candidate;
    }

    /**
     * Normalize email address (trim whitespace and lowercase).
     */
    public static function normalizeEmail(?string $email): string
    {
        if (empty($email)) {
            return '';
        }

        return strtolower(trim($email));
    }

    /**
     * Normalize phone number by extracting digits and standardizing Indonesian country code.
     * (e.g. "+62 812-3456-7890", "6281234567890", "0812 3456 7890" -> "081234567890")
     */
    public static function normalizePhone(?string $phone): string
    {
        if (empty($phone)) {
            return '';
        }

        $digits = preg_replace('/[^0-9]/', '', $phone);

        if (str_starts_with($digits, '62') && strlen($digits) >= 10) {
            $digits = '0' . substr($digits, 2);
        }

        return $digits;
    }

    /**
     * Check if an active booking exists with matching email or phone.
     * Active statuses: 'confirmed', 'pending'.
     * Cancelled bookings ('cancelled') are explicitly excluded.
     * If $excludeBookingNumber is provided (for Reschedule), that record is excluded.
     *
     * @return array{email_duplicate: bool, phone_duplicate: bool, is_duplicate: bool}
     */
    public static function checkDuplicateActiveBooking(string $email, string $phone, ?string $excludeBookingNumber = null, bool $lockForUpdate = false): array
    {
        $normalizedInputEmail = self::normalizeEmail($email);
        $normalizedInputPhone = self::normalizePhone($phone);

        $query = static::query()
            ->whereIn('status', ['confirmed', 'pending']);

        if (! empty($excludeBookingNumber)) {
            $query->where('booking_number', '!=', $excludeBookingNumber);
        }

        if ($lockForUpdate) {
            $query->lockForUpdate();
        }

        $activeBookings = $query->get();

        $emailDuplicate = false;
        $phoneDuplicate = false;

        foreach ($activeBookings as $booking) {
            $existingEmail = self::normalizeEmail($booking->email);
            $existingPhone = self::normalizePhone($booking->phone);

            if ($normalizedInputEmail !== '' && $existingEmail === $normalizedInputEmail) {
                $emailDuplicate = true;
            }

            if ($normalizedInputPhone !== '' && $existingPhone === $normalizedInputPhone) {
                $phoneDuplicate = true;
            }
        }

        return [
            'email_duplicate' => $emailDuplicate,
            'phone_duplicate' => $phoneDuplicate,
            'is_duplicate' => ($emailDuplicate || $phoneDuplicate),
        ];
    }
}
