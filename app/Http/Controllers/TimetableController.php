<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use App\Models\Program;
use App\Services\TimetableGeneratorService;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    /**
     * Display the timetable grid.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $programs = Program::all();
        $selected_program = $request->get('program_id');
        
        $query = Timetable::with(['course.program', 'lecturer.user', 'room']);
        
        // Role-based filtering
        if ($user->role === 'student') {
            $query->whereHas('course', function($q) use ($user) {
                $q->where('program_id', $user->program_id)->where('year', $user->year);
            });
        } elseif ($user->role === 'lecturer' && $user->lecturer) {
            $query->where('lecturer_id', $user->lecturer->id);
        } elseif ($selected_program) {
            $query->whereHas('course', function($q) use ($selected_program) {
                $q->where('program_id', $selected_program);
            });
        }

        $timetables = $query->get()->groupBy('day');
        
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $slots = ['08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00', '17:00:00'];

        return view('timetables.grid', compact('timetables', 'programs', 'days', 'slots', 'selected_program'));
    }

    /**
     * Trigger automatic generation.
     */
    public function generate(TimetableGeneratorService $generator)
    {
        $generator->generate();
        return redirect()->route('timetables.index')->with('success', 'Timetable generated successfully without conflicts.');
    }
}
