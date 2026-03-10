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
        // Programs
        $cs = \App\Models\Program::create(['program_name' => 'Computer Science', 'faculty' => 'Science and Technology']);
        $eng = \App\Models\Program::create(['program_name' => 'Software Engineering', 'faculty' => 'Science and Technology']);

        // Users & Lecturers
        $admin = \App\Models\User::create([
            'name' => 'System Admin',
            'email' => 'admin@chauts.edu.zm',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $lecturer1User = \App\Models\User::create([
            'name' => 'Dr. Banda',
            'email' => 'banda@chauts.edu.zm',
            'password' => bcrypt('password'),
            'role' => 'lecturer',
        ]);
        $lec1 = \App\Models\Lecturer::create(['user_id' => $lecturer1User->id, 'department' => 'Computer Science']);

        $lecturer2User = \App\Models\User::create([
            'name' => 'Prof. Mwale',
            'email' => 'mwale@chauts.edu.zm',
            'password' => bcrypt('password'),
            'role' => 'lecturer',
        ]);
        $lec2 = \App\Models\Lecturer::create(['user_id' => $lecturer2User->id, 'department' => 'Software Engineering']);

        // Courses
        $c1 = \App\Models\Course::create([
            'course_code' => 'CSC101',
            'course_name' => 'Introduction to Programming',
            'program_id' => $cs->id,
            'year' => 1,
            'semester' => 1,
        ]);
        $c1->lecturers()->attach($lec1->id);

        $c2 = \App\Models\Course::create([
            'course_code' => 'CSC201',
            'course_name' => 'Data Structures',
            'program_id' => $cs->id,
            'year' => 2,
            'semester' => 1,
        ]);
        $c2->lecturers()->attach($lec1->id);

        $c3 = \App\Models\Course::create([
            'course_code' => 'SEN101',
            'course_name' => 'Software Foundations',
            'program_id' => $eng->id,
            'year' => 1,
            'semester' => 1,
        ]);
        $c3->lecturers()->attach($lec2->id);

        // Student
        \App\Models\User::create([
            'name' => 'John Doe',
            'email' => 'student@chauts.edu.zm',
            'password' => bcrypt('password'),
            'role' => 'student',
            'program_id' => $cs->id,
            'year' => 1,
        ]);

        // Rooms
        \App\Models\Room::create(['room_name' => 'LT1', 'capacity' => 100]);
        \App\Models\Room::create(['room_name' => 'LT2', 'capacity' => 80]);
        \App\Models\Room::create(['room_name' => 'Lab 1', 'capacity' => 40]);
    }
}
