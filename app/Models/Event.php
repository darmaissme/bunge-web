<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'name',
        'slug',
        'venue',
        'city',
        'hall',
        'booth',
        'dates',
        'opening_time',
        'closing_time',
        'timezone',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function getActiveEvent(): ?static
    {
        return static::where('is_active', true)->first();
    }
}
