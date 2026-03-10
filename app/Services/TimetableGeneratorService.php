<?php

namespace App\Services;

use App\Models\Timetable;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Room;
use Carbon\Carbon;

class TimetableGeneratorService
{
    protected $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    protected $start_hour = 8; // 08:00
    protected $end_hour = 17;   // 17:00
    protected $slot_duration = 1; // Hours per slot

    /**
     * Generate the timetable for all courses.
     */
    public function generate()
    {
        // 1. Clear existing timetable entries (Optional, or skip if you want to increment)
        Timetable::truncate();

        // 2. Priority courses (e.g. combined classes) could go first, but for now just all
        $courses = Course::all();

        foreach ($courses as $course) {
            $assigned = false;
            
            // Try to find a lecturer for this course
            $lecturer = $course->lecturers->first();
            if (!$lecturer) continue;

            // Loop through days and time slots
            foreach ($this->days as $day) {
                for ($hour = $this->start_hour; $hour < $this->end_hour; $hour += $this->slot_duration) {
                    $start_time = Carbon::createFromTime($hour, 0, 0)->format('H:i:s');
                    $end_time = Carbon::createFromTime($hour + $this->slot_duration, 0, 0)->format('H:i:s');

                    // Check if lecturer is available
                    if ($this->isLecturerBusy($lecturer->id, $day, $start_time, $end_time)) {
                        continue;
                    }

                    // Check if program/year is busy
                    if ($this->isProgramBusy($course->program_id, $course->year, $day, $start_time, $end_time)) {
                        continue;
                    }

                    // Find an available room
                    $room = $this->findAvailableRoom($day, $start_time, $end_time);
                    if (!$room) continue;

                    // Assign the slot!
                    Timetable::create([
                        'course_id' => $course->id,
                        'lecturer_id' => $lecturer->id,
                        'room_id' => $room->id,
                        'day' => $day,
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                    ]);

                    $assigned = true;
                    break;
                }
                if ($assigned) break;
            }
        }

        return true;
    }

    protected function isLecturerBusy($lecturer_id, $day, $start, $end)
    {
        return Timetable::where('lecturer_id', $lecturer_id)
            ->where('day', $day)
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_time', [$start, $end])
                      ->orWhereBetween('end_time', [$start, $end]);
            })->exists();
    }

    protected function isProgramBusy($program_id, $year, $day, $start, $end)
    {
        return Timetable::whereHas('course', function($q) use ($program_id, $year) {
                $q->where('program_id', $program_id)->where('year', $year);
            })
            ->where('day', $day)
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_time', [$start, $end])
                      ->orWhereBetween('end_time', [$start, $end]);
            })->exists();
    }

    protected function findAvailableRoom($day, $start, $end)
    {
        $busy_rooms = Timetable::where('day', $day)
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_time', [$start, $end])
                      ->orWhereBetween('end_time', [$start, $end]);
            })
            ->pluck('room_id');

        return Room::whereNotIn('id', $busy_rooms)->first();
    }
}
