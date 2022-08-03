<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name', 'faculty_id'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
