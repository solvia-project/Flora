<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkshopClass extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'name',
        'description',
        'price',
        'location',
        'starts_at',
        'duration_minutes',
        'max',
        'day',
        'time_1',
        'time_2',
        'image_path',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'price' => 'decimal:2',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'class_id');
    }
}
