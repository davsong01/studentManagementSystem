<?php

namespace App\Models;

use App\Models\Faculty;
use App\Models\Department;
use NumberFormatter;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['course_code', "course_title", "faculty_id", "department_id", "program", "semester", "level", "units", "type"];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function getSemesterAttribute($value)
    {
        $formatter = new NumberFormatter('en-US', NumberFormatter::ORDINAL);
        return ucfirst($formatter->format($value));
    }
}
