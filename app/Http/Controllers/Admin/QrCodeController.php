<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use Illuminate\Http\Request;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;
use Illuminate\Support\Str;
use App\Models\LectureAttendance;
use App\Models\Student;
use App\Models\Subject;
use App\Models\StudentSubjectAttendance;

class QrCodeController extends Controller
{
    /**
     * Show the QR code generation page.
     */
    public function index()
    {
        return view('admin.generate-qr');
    }

    /**
     * Generate a time-limited QR code for attendance.
     */
    public function generateQrCode(Request $request)
    {
        $request->validate([
            'lecture_id' => 'required|exists:lectures,id',
        ]);

        $lecture = Lecture::with('hall', 'user')->findOrFail($request->lecture_id);

        // Always generate a new QR code for attendance
        $qrCode = (string) Str::uuid();
        $lecture->qr_code = $qrCode;
        $lecture->save();

    // Initialize attendance records for eligible students as 'absent'
    $subject = Subject::find($lecture->subject_id);
    if ($subject) {
        $eligibleStudents = Student::where('department_id', $lecture->department_id)
            ->where('year', $subject->year)
            ->where(function($q) use ($subject) {
                $q->where('semester', $subject->semester)
                  ->orWhereNull('semester');
            })
            ->pluck('id');

        foreach ($eligibleStudents as $studentId) {
            LectureAttendance::firstOrCreate(
                [
                    'student_id' => $studentId,
                    'lecture_id' => $lecture->id,
                ],
                [
                    'status' => 'absent',
                    'scanned_at' => null,
                ]
            );

            // Increment absence_count in student_subject_attendances
            StudentSubjectAttendance::firstOrCreate(
                [
                    'student_id' => $studentId,
                    'subject_id' => $lecture->subject_id,
                ],
                [
                    'presence_count' => 0,
                    'absence_count' => 0,
                ]
            )->increment('absence_count');
        }
    }

        // URL for attendance scan
        $attendanceUrl = url('/student/scan-qr?qr=' . $qrCode);

        // Generate QR code SVG using BaconQrCode directly
        $renderer = new ImageRenderer(
            new RendererStyle(250),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrCodeSvg = $writer->writeString($attendanceUrl);

        return response()->json([
            'success' => true,
            'qr_code_svg' => $qrCodeSvg,
            'lecture' => $lecture,
            'attendance_url' => $attendanceUrl,
        ]);
    }
}
