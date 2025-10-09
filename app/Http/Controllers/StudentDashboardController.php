<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lecture;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Fetch upcoming lectures for the student
        $lectures = Lecture::where('user_id', $user->id)
            ->where('start_time', '>=', now())
            ->orderBy('start_time')
            ->get();

        return view('student.dashboard', compact('lectures'));
    }
}
