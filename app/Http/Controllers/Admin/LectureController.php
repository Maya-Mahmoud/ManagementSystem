<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\Hall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return Lecture::with(['hall', 'user'])->get();
        }

        $halls = Hall::all();
        return view('admin.lecture-management', compact('halls'));
    }

    /**
     * Display the advanced scheduler page.
     */
    public function advancedScheduler()
    {
        $halls = Hall::all();
        return view('admin.advanced-scheduler', compact('halls'));
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'subject' => 'required|string|max:255',
                //'professor' => 'required|string|max:255', // Removed professor from validation
                'hall_id' => 'required|exists:halls,id',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time',
                'max_students' => 'nullable|integer|min:1', // Changed to nullable
                'recurringLecture' => 'nullable|boolean',
                'repeat_pattern' => ['nullable', Rule::in(['daily', 'weekly', 'monthly'])],
                'end_date' => 'nullable|date|after:start_time',
            ]);

            // Always set professor field to logged-in user's name
            $validated['professor'] = Auth::user()->name;

            $validated['user_id'] = Auth::id();

            // Handle recurring lectures
            if (!empty($validated['recurringLecture']) && $validated['recurringLecture']) {
                $startDate = new \DateTime($validated['start_time']);
                $endDate = new \DateTime($validated['end_date']);
                $intervalSpec = 'P1W'; // Default weekly
                if ($validated['repeat_pattern'] === 'daily') {
                    $intervalSpec = 'P1D';
                } elseif ($validated['repeat_pattern'] === 'monthly') {
                    $intervalSpec = 'P1M';
                }
                $interval = new \DateInterval($intervalSpec);
                $period = new \DatePeriod($startDate, $interval, $endDate);

                $lectures = [];
                foreach ($period as $date) {
                    $start = $date->format('Y-m-d H:i:s');
                    $end = (clone $date)->add(new \DateInterval('PT' . (strtotime($validated['end_time']) - strtotime($validated['start_time'])) . 'S'))->format('Y-m-d H:i:s');

                    $lectures[] = [
                        'title' => $validated['title'],
                        'subject' => $validated['subject'],
                        'professor' => $validated['professor'],
                        'hall_id' => $validated['hall_id'],
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

                return response()->json([
                    'success' => true,
                    'message' => 'Recurring lectures created successfully!',
                ], 201);
            }

            // Remove professor from validated before create to avoid mass assignment error
            $professorName = $validated['professor'] ?? null;
            unset($validated['professor']);

            $lecture = Lecture::create($validated);

            // Generate unique QR code
            $lecture->qr_code = Str::uuid();
            $lecture->save();

            // Update professor field separately
            if ($professorName) {
                $lecture->professor = $professorName;
                $lecture->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Lecture created successfully!',
                'data' => $lecture->load(['hall', 'user'])
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error storing lecture: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to schedule lecture due to server error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lecture = Lecture::with(['hall', 'user'])->findOrFail($id);

        return response()->json($lecture);
    }

    /**
     * Get lectures for a specific date.
     */
    public function lecturesByDate(Request $request)
    {
        $date = $request->query('date');
        if (!$date) {
            return response()->json(['error' => 'Date parameter is required'], 400);
        }

        $lectures = Lecture::with(['hall', 'user'])
            ->whereDate('start_time', $date)
            ->get();

        return response()->json($lectures);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lecture = Lecture::findOrFail($id);
        $lecture->delete();

        return response()->json([
            'success' => true,
            'message' => 'Lecture deleted successfully!'
        ]);
    }
}
