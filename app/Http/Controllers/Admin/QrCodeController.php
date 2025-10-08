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

        // Always generate a new QR code for attendance
        $qrCode = (string) Str::uuid();
        $lecture->qr_code = $qrCode;
        $lecture->save();

        // URL for attendance scan
        $attendanceUrl = url('/student/attendance/scan?qr=' . $qrCode);

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
