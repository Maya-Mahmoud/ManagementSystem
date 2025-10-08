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

        // Generate a unique token for attendance session (e.g., UUID)
        $attendanceToken = (string) Str::uuid();

        // Store the token with lecture and expiration in DB or cache (not implemented here)
        // For demo, we encode a URL with token and lecture id

        // Since route 'student.attendance.scan' is not defined, use a placeholder URL or define the route accordingly
        $attendanceUrl = url('/student/attendance/scan?token=' . $attendanceToken . '&lecture=' . $lecture->id);

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
