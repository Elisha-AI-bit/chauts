<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lecturers = Lecturer::with('user')->latest()->paginate(10);
        return view('lecturers.index', compact('lecturers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only get users that are not already assigned a lecturer profile
        $users = User::where('role', 'lecturer')
            ->whereDoesntHave('lecturer')
            ->get();
        return view('lecturers.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:lecturers',
            'department' => 'required|string|max:255',
        ]);

        Lecturer::create($validated);
        return redirect()->route('lecturers.index')->with('success', 'Lecturer profile created successfully.');
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
        $lecturer = Lecturer::findOrFail($id);
        $users = User::where('role', 'lecturer')->get();
        return view('lecturers.edit', compact('lecturer', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:lecturers,user_id,'.$id,
            'department' => 'required|string|max:255',
        ]);

        $lecturer = Lecturer::findOrFail($id);
        $lecturer->update($validated);
        return redirect()->route('lecturers.index')->with('success', 'Lecturer profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lecturer = Lecturer::findOrFail($id);
        $lecturer->delete();
        return redirect()->route('lecturers.index')->with('success', 'Lecturer profile deleted successfully.');
    }
}
