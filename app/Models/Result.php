<?php

namespace App\Models;

use App\Models\User;
use NumberFormatter;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $guarded = [];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function getSemesterAttribute($value)
    {
        $formatter = new NumberFormatter('en-US', NumberFormatter::ORDINAL);
        return ucfirst($formatter->format($value));
    }
}
