<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hall;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class HallBookingController extends Controller
{
    public function index()
    {
        $halls = Hall::with('currentBooking')->get();
        return view('halls.index', compact('halls'));
    }

    public function book(Request $request, Hall $hall)
    {
        if ($hall->status === 'available' && Auth::check()) {
            // Check for overlapping lectures
            $now = now();
            $overlappingLectures = $hall->lectures()
                ->where('start_time', '<=', $now)
                ->where('end_time', '>', $now)
                ->exists();

            if ($overlappingLectures) {
                return redirect()->route('halls.index')->with('error', 'Cannot book this hall as it has an ongoing lecture.');
            }

            Booking::create([
                'user_id' => Auth::id(),
                'hall_id' => $hall->id,
                'booked_at' => $now,
                'status' => 'booked',
            ]);

            $hall->update(['status' => 'booked']);

            return redirect()->route('halls.index')->with('success', 'Hall booked successfully!');
        }

        return redirect()->route('halls.index')->with('error', 'Cannot book this hall.');
    }

    public function release(Request $request, Hall $hall)
    {
        if ($hall->status === 'booked' && Auth::check()) {
            $booking = $hall->currentBooking;
            if ($booking && $booking->user_id === Auth::id()) {
                $booking->update(['status' => 'cancelled']);
                // Recompute status based on lectures instead of directly setting to available
                $hall->updateStatusBasedOnLectures();

                return redirect()->route('halls.index')->with('success', 'Hall released successfully!');
            }
        }

        return redirect()->route('halls.index')->with('error', 'Cannot release this hall.');
    }
}
