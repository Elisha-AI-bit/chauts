<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Program;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('program')->latest()->paginate(10);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Program::all();
        return view('courses.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_code' => 'required|string|max:255|unique:courses',
            'course_name' => 'required|string|max:255',
            'program_id' => 'required|exists:programs,id',
            'year' => 'required|integer|min:1|max:7',
            'semester' => 'required|integer|min:1|max:3',
        ]);

        Course::create($validated);
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        $programs = Program::all();
        return view('courses.edit', compact('course', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'course_code' => 'required|string|max:255|unique:courses,course_code,'.$id,
            'course_name' => 'required|string|max:255',
            'program_id' => 'required|exists:programs,id',
            'year' => 'required|integer|min:1|max:7',
            'semester' => 'required|integer|min:1|max:3',
        ]);

        $course = Course::findOrFail($id);
        $course->update($validated);
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
