<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_code',
        'course_name',
        'program_id',
        'year',
        'semester',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function lecturers()
    {
        return $this->belongsToMany(Lecturer::class);
    }
}
