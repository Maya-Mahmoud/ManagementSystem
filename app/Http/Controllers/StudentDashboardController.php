<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lecture;
use App\Models\Subject;

class StudentDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $student = $user->student;

        $departmentId = $student->department_id;
        $studentYear = strtolower($student->year ?? 'first');
        $studentSemester = strtolower($student->semester ?? 'first');

        $year = strtolower($request->input('year', $studentYear));
        $semester = strtolower($request->input('semester', $studentSemester));
        $date = $request->input('date');

        $query = Lecture::join('subjects', 'lectures.subject', '=', 'subjects.name')
            ->where('lectures.department_id', $departmentId)
            ->where('subjects.year', $year)
            ->where('subjects.semester', $semester)
            ->select('lectures.*')
            ->with('hall');

        if ($date) {
            $startOfDay = \Carbon\Carbon::parse($date)->startOfDay();
            $endOfDay = \Carbon\Carbon::parse($date)->endOfDay();
            $query->whereBetween('lectures.start_time', [$startOfDay, $endOfDay]);
        } else {
            $query->where('lectures.start_time', '>=', now());
        }

        $lectures = $query->orderBy('lectures.start_time')->get();

        // Display versions
        $displayYear = ucfirst($year);
        $displaySemester = ucfirst($semester);

        return view('student.dashboard', compact('lectures', 'displayYear', 'displaySemester', 'date'));
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
