<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Subject::query();

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }

        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        $subjects = $query->get();
        return view('admin.subjects', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'semester' => 'required|in:first,second',
            'year' => 'required|in:first,second,third,fourth,fifth',
            'department' => 'required|in:communications,energy,marine,design_and_production,computers,medical,mechatronics,power',
        ]);

        Subject::create($request->all());

        return redirect()->route('admin.subjects')->with('success', 'Subject added successfully.');
    }
}
