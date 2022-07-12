<?php

namespace App;

use App\User;
use App\Attendance;
use App\Department;
use NumberFormatter;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'parent_id',
        'class_id',
        'roll_number',
        'gender',
        'phone',
        'dateofbirth',
        'current_address',
        "program",
        "level",
        "semester",
        "department_id",
        "faculty_id",
        "state_of_origin",
        "lga",
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function department() 
    {
        return $this->belongsTo(Department::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function attendances() 
    {
        return $this->hasMany(Attendance::class);
    }

    public function getSemesterAttribute($value)
    {
        $formatter = new NumberFormatter('en-US', NumberFormatter::ORDINAL);
        return ucfirst($formatter->format($value));
    }
}
