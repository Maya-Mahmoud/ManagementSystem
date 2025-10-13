<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\Hall;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class LectureController extends Controller
{
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $query = Lecture::with(['hall', 'user']);
            if (Auth::user()->role === 'professor') {
                $query->where('user_id', Auth::id());
            }
            return $query->get();
        }

        $halls = Hall::all();
        $subjects = Subject::all();
        $departments = \App\Models\Department::all();
        return view('admin.lecture-management', compact('halls', 'subjects', 'departments'));
    }

    public function advancedScheduler()
    {
        $halls = Hall::all();
        return view('admin.advanced-scheduler', compact('halls'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'subject' => 'required|string|max:255',
                'department' => 'required|string',
                'hall_id' => 'required|exists:halls,id',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time',
                'max_students' => 'nullable|integer|min:1',
                'recurringLecture' => 'nullable|boolean',
                'repeat_pattern' => ['nullable', Rule::in(['daily', 'weekly', 'monthly'])],
                'end_date' => 'nullable|date|after:start_time',
            ]);

            Log::info('Lecture creation attempt', ['validated_data' => $validated]);

            $departmentMapping = [
                'الاتصالات' => 'communications',
                'الطاقة' => 'energy',
                'البحرية' => 'marine',
                'التصميم والإنتاج' => 'design_and_production',
                'الحواسيب' => 'computers',
                'الطبية' => 'medical',
                'الميكاترونيكس' => 'mechatronics',
                'الطاقة' => 'power',
            ];

            $dbDepartmentName = $departmentMapping[$validated['department']] ?? $validated['department'];
            $department = \App\Models\Department::whereRaw('LOWER(name) = LOWER(?)', [$dbDepartmentName])->firstOrFail();
            $validated['department_id'] = $department->id;

            $subject = Subject::whereRaw('LOWER(name) = LOWER(?)', [$validated['subject']])->firstOrFail();
            $validated['subject_id'] = $subject->id;

            $validated['professor'] = Auth::user()->name;
            $validated['user_id'] = Auth::id();

            // Handle recurring lectures
            if (!empty($validated['recurringLecture']) && $validated['recurringLecture']) {
                $startDate = new \DateTime($validated['start_time']);
                $endDate = new \DateTime($validated['end_date']);
                $intervalSpec = 'P1W';
                if ($validated['repeat_pattern'] === 'daily') $intervalSpec = 'P1D';
                elseif ($validated['repeat_pattern'] === 'monthly') $intervalSpec = 'P1M';
                $interval = new \DateInterval($intervalSpec);
                $period = new \DatePeriod($startDate, $interval, $endDate);

                $lectures = [];
                foreach ($period as $date) {
                    $start = $date->format('Y-m-d H:i:s');
                    $end = (clone $date)->add(new \DateInterval('PT' . (strtotime($validated['end_time']) - strtotime($validated['start_time'])) . 'S'))->format('Y-m-d H:i:s');

                    $lectures[] = [
                        'title' => $validated['title'],
                        'subject' => $validated['subject'],
                        'subject_id' => $validated['subject_id'],
                        'professor' => $validated['professor'],
                        'hall_id' => $validated['hall_id'],
                        'department_id' => $validated['department_id'],
                        'start_time' => $start,
                        'end_time' => $end,
                        'max_students' => $validated['max_students'],
                        'user_id' => $validated['user_id'],
                        'qr_code' => Str::uuid(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                Lecture::insert($lectures);

                return response()->json(['success' => true, 'message' => 'Recurring lectures created successfully!'], 201);
            }

            $professorName = $validated['professor'] ?? null;
            unset($validated['professor']);
            unset($validated['department']);

            $lecture = Lecture::create($validated);
            $lecture->qr_code = Str::uuid();
            $lecture->save();

            if ($professorName) {
                $lecture->professor = $professorName;
                $lecture->save();
            }

            return response()->json(['success' => true, 'message' => 'Lecture created successfully!', 'data' => $lecture->load(['hall', 'user'])], 201);
        } catch (\Exception $e) {
            Log::error('Error storing lecture: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to schedule lecture due to server error.', 'error' => $e->getMessage()], 500);
        }
    }

public function showAttendance($id)
{
    $lecture = Lecture::with(['hall', 'user', 'subject'])->findOrFail($id);
    $attendances = \App\Models\LectureAttendance::with(['student.user'])
        ->where('lecture_id', $id)
        ->get();

    // Load subject separately to ensure it works
    $subject = null;
    if ($lecture->subject_id) {
        $subject = Subject::find($lecture->subject_id);
    }
    if (!$subject && $lecture->subject) {
        // Fallback: find subject by name if subject_id is null
        $subject = Subject::whereRaw('LOWER(name) = LOWER(?)', [$lecture->subject])->first();
    }

    // Calculate total students based on department and year
    $totalStudents = 0;
    if ($subject) {
        // Get department_id from subject (which has department_id)
        $departmentId = $subject->department_id;
        $year = $subject->year;

        $totalStudents = Student::where('department_id', $departmentId)
            ->where('year', $year)
            ->count();
    }

    $presentCount = $attendances->where('status', 'present')->count(); // عدد الحاضرين
    $absentCount = max(0, $totalStudents - $presentCount); // عدد الغائبين (الفرق)

    Log::info('Lecture Attendance Debug', [
        'lecture_id' => $id,
        'subject_name' => $subject ? $subject->name : null,
        'subject_department' => $subject ? $subject->department : null,
        'subject_year' => $subject ? $subject->year : null,
        'department_id' => $department->id ?? null,
        'totalStudents' => $totalStudents,
        'presentCount' => $presentCount,
        'absentCount' => $absentCount
    ]);

    return view('admin.lecture-attendance', compact('lecture', 'attendances', 'totalStudents', 'presentCount', 'absentCount'));
}
    public function show(string $id)
    {
        $lecture = Lecture::with(['hall', 'user'])->findOrFail($id);
        return response()->json($lecture);
    }

    public function lecturesByDate(Request $request)
    {
        $date = $request->query('date');
        if (!$date) return response()->json(['error' => 'Date parameter is required'], 400);

        $query = Lecture::with(['hall', 'user'])->whereDate('start_time', $date);
        if (Auth::user()->role === 'professor') $query->where('user_id', Auth::id());
        return response()->json($query->get());
    }

    public function update(Request $request, string $id)
    {
        $lecture = Lecture::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'hall_id' => 'required|exists:halls,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $lecture->update($validated);
        return response()->json([
            'success' => true,
            'message' => 'Lecture updated successfully!',
            'data' => $lecture->load(['hall', 'user'])
        ]);
    }

    public function destroy(string $id)
    {
        $lecture = Lecture::findOrFail($id);
        $lecture->delete();

        return response()->json([
            'success' => true,
            'message' => 'Lecture deleted successfully!'
        ]);
    }

    public function exportAttendance($id)
    {
        $lecture = Lecture::findOrFail($id);
        $attendances = \App\Models\LectureAttendance::with(['student.user'])
            ->where('lecture_id', $id)
            ->get();

        $filename = 'lecture_attendance_' . $lecture->id . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($attendances) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Student Name', 'Status', 'Scanned At']);

            foreach ($attendances as $attendance) {
                fputcsv($file, [
                    $attendance->student->user->name,
                    ucfirst($attendance->status),
                    $attendance->scanned_at ? $attendance->scanned_at->format('Y-m-d H:i:s') : 'N/A'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}