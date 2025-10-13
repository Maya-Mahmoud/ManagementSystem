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

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        $subjects = $query->with('department')->get();
        $departments = \App\Models\Department::all();
        return view('admin.subjects', compact('subjects', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'semester' => 'required|in:first,second',
            'year' => 'required|in:first,second,third,fourth,fifth',
            'department_id' => 'required|exists:departments,id',
        ]);

        $department = \App\Models\Department::find($request->department_id);

        Subject::create([
            'name' => $request->name,
            'semester' => $request->semester,
            'year' => $request->year,
            'department_id' => $request->department_id,
            'department' => $department->name,
        ]);

        return redirect()->route('admin.subjects')->with('success', 'Subject added successfully.');
    }
}
