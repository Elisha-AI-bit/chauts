<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ImportController extends Controller
{
    public function index()
    {
        return view('admin.import');
    }

    public function downloadTemplate($type)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$type}_template.csv\"",
        ];

        $columns = match ($type) {
            'programs' => ['program_name', 'faculty'],
            'courses' => ['course_code', 'course_name', 'program_name', 'year', 'semester'],
            'lecturers' => ['name', 'email', 'department'],
            'rooms' => ['room_name', 'capacity'],
            default => abort(404),
        };

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function importPrograms(Request $request)
    {
        $request->validate(['file' => 'required|mimes:csv,txt']);
        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), 'r');
        fgetcsv($handle); // skip header

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            Program::updateOrCreate(
                ['program_name' => $data[0]],
                ['faculty' => $data[1]]
            );
        }
        fclose($handle);
        return redirect()->back()->with('success', 'Programs imported successfully.');
    }

    public function importCourses(Request $request)
    {
        $request->validate(['file' => 'required|mimes:csv,txt']);
        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), 'r');
        fgetcsv($handle); // skip header

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $program = Program::where('program_name', $data[2])->first();
            
            if (!$program) continue; // Skip if program not found

            Course::updateOrCreate(
                ['course_code' => $data[0]],
                [
                    'course_name' => $data[1],
                    'program_id' => $program->id,
                    'year' => $data[3],
                    'semester' => $data[4]
                ]
            );
        }
        fclose($handle);
        return redirect()->back()->with('success', 'Courses imported successfully.');
    }

    public function importLecturers(Request $request)
    {
        $request->validate(['file' => 'required|mimes:csv,txt']);
        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), 'r');
        fgetcsv($handle); // skip header

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $user = User::updateOrCreate(
                ['email' => $data[1]],
                [
                    'name' => $data[0],
                    'password' => Hash::make('password'),
                    'role' => 'lecturer'
                ]
            );

            Lecturer::updateOrCreate(
                ['user_id' => $user->id],
                ['department' => $data[2]]
            );
        }
        fclose($handle);
        return redirect()->back()->with('success', 'Lecturers imported successfully.');
    }

    public function importRooms(Request $request)
    {
        $request->validate(['file' => 'required|mimes:csv,txt']);
        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), 'r');
        fgetcsv($handle); // skip header

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            Room::updateOrCreate(
                ['room_name' => $data[0]],
                ['capacity' => $data[1]]
            );
        }
        fclose($handle);
        return redirect()->back()->with('success', 'Rooms imported successfully.');
    }
}
