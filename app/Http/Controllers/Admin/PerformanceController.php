<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\StudentSubjectAttendance;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index(Request $request)
    {
        $departments = \App\Models\Department::all();

        // Calculate initial stats
        $stats = $this->calculateStats($request);

        // If AJAX request for subjects
        if ($request->expectsJson() || $request->is('admin/api/*')) {
            return $this->getSubjects($request);
        }

        return view('admin.performance', compact('departments', 'stats'));
    }

    private function calculateStats(Request $request)
    {
        $studentQuery = \App\Models\Student::query();

        if ($request->filled('year')) {
            $studentQuery->where('year', $request->year);
        }

        if ($request->filled('department_id')) {
            $studentQuery->whereHas('user', function ($q) use ($request) {
                $q->where('department_id', $request->department_id);
            });
        }

        $totalStudents = $studentQuery->count();

        $subjectQuery = Subject::query();

        if ($request->filled('year')) {
            $subjectQuery->where('year', $request->year);
        }

        if ($request->filled('department_id')) {
            $subjectQuery->where('department_id', $request->department_id);
        }

        $subjects = $subjectQuery->get();
        $totalAttendanceRate = 0;
        $totalAbsenceRate = 0;
        $subjectCount = $subjects->count();

        if ($subjectCount > 0) {
            foreach ($subjects as $subject) {
                $attendanceData = StudentSubjectAttendance::where('subject_id', $subject->id)->get();
                $totalPresence = $attendanceData->sum('presence_count');
                $totalAbsence = $attendanceData->sum('absence_count');
                $total = $totalPresence + $totalAbsence;
                if ($total > 0) {
                    $attendanceRate = ($totalPresence / $total) * 100;
                    $absenceRate = ($totalAbsence / $total) * 100;
                    $totalAttendanceRate += $attendanceRate;
                    $totalAbsenceRate += $absenceRate;
                }
            }
            $averageAttendance = round($totalAttendanceRate / $subjectCount, 2);
            $averageAbsence = round($totalAbsenceRate / $subjectCount, 2);
        } else {
            $averageAttendance = 0;
            $averageAbsence = 0;
        }

        return [
            'total_students' => $totalStudents,
            'average_attendance' => $averageAttendance,
            'average_absence' => $averageAbsence,
        ];
    }

    private function getSubjects(Request $request)
    {
        $query = Subject::query()->with(['department', 'lectures']);

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->filled('subject_id')) {
            $query->where('id', $request->subject_id);
        }

        $subjects = $query->get()->map(function ($subject) {
            $attendanceData = StudentSubjectAttendance::where('subject_id', $subject->id)->get();
            $totalPresence = $attendanceData->sum('presence_count');
            $totalAbsence = $attendanceData->sum('absence_count');
            $totalLectures = $subject->lectures->count();

            return [
                'id' => $subject->id,
                'name' => $subject->name,
                'year' => $subject->year,
                'semester' => $subject->semester,
                'department' => $subject->department ? $subject->department->name : 'N/A',
                'total_lectures' => $totalLectures,
                'total_presence' => $totalPresence,
                'total_absence' => $totalAbsence,
                'attendance_rate' => $totalLectures > 0 ? round(($totalPresence / ($totalPresence + $totalAbsence)) * 100, 2) : 0,
            ];
        });

        return response()->json($subjects);
    }

    public function getSubjectsApi(Request $request)
    {
        $query = Subject::query();

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        $subjects = $query->get(['id', 'name']);

        return response()->json($subjects);
    }

    public function getStatsApi(Request $request)
    {
        $stats = $this->calculateStats($request);
        return response()->json($stats);
    }
}
