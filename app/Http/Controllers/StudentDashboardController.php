<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lecture;
use App\Models\Subject;

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

    public function subjects(Request $request)
    {
        $user = Auth::user();
        $student = $user->student;

        // السنة والفصل الافتراضيين (من حساب الطالب)
        $studentYear = $student->year ?? 'first';
        $studentSemester = $student->semester ?? 'first';
        $year = strtolower($request->input('year', $studentYear));
        $semester = strtolower($request->input('semester', $studentSemester));
        $department = strtolower($student->department->name ?? '');

        // Display versions for view (capitalized)
        $displayYear = ucfirst($year);
        $displaySemester = ucfirst($semester);

        // فلترة المواد حسب القسم والسنة والفصل
        $subjects = Subject::where('department', $department)
            ->where('year', $year)
            ->where('semester', $semester)
            ->get();

        return view('student.subjects', compact('subjects', 'displayYear', 'displaySemester'));
    }
}
