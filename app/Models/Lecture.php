<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject',
        'professor',
        'hall_id',
        'user_id',
        'start_time',
        'end_time',
        'max_students',
        'qr_code',
        'department_id',
        'subject_id',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    
    public function attendances()
{
    return $this->hasMany(StudentSubjectAttendance::class, 'lecture_id');
}

    /**
     * Check if this lecture overlaps with another lecture or booking.
     */
    public function overlapsWith($other)
    {
        if ($other instanceof Lecture) {
            return $this->start_time < $other->end_time && $this->end_time > $other->start_time;
        } elseif ($other instanceof \App\Models\Booking) {
            // Assuming Booking has end_time; if not, treat as point-in-time
            $bookingEnd = $other->end_time ?? $other->booked_at;
            return $this->start_time < $bookingEnd && $this->end_time > $other->booked_at;
        }
        return false;
    }

}
