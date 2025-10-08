<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hall extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hall_name',
        'capacity',
        'building',
        'floor',
        'equipment',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function currentBooking()
    {
        return $this->hasOne(Booking::class)->where('status', 'booked')->latest();
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

}
