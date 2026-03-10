<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $program = \App\Models\Program::create([
            'program_name' => 'Computer Science',
            'faculty' => 'Science and Technology',
        ]);

        \App\Models\Course::create([
            'course_code' => 'CSC101',
            'course_name' => 'Introduction to Programming',
            'program_id' => $program->id,
            'year' => 1,
            'semester' => 1,
        ]);

        \App\Models\User::create([
            'name' => 'System Admin',
            'email' => 'admin@chauts.edu.zm',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'John Doe',
            'email' => 'student@chauts.edu.zm',
            'password' => bcrypt('password'),
            'role' => 'student',
            'program_id' => $program->id,
            'year' => 1,
        ]);
        
        $lecturerUser = \App\Models\User::create([
            'name' => 'Dr. Banda',
            'email' => 'banda@chauts.edu.zm',
            'password' => bcrypt('password'),
            'role' => 'lecturer',
        ]);

        \App\Models\Lecturer::create([
            'user_id' => $lecturerUser->id,
            'department' => 'Computer Science',
        ]);

        \App\Models\Room::create([
            'room_name' => 'LT1',
            'capacity' => 100,
        ]);
        \App\Models\Room::create([
            'room_name' => 'LT2',
            'capacity' => 80,
        ]);
    }
}
