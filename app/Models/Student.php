<?php

namespace App\Models;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Department;
use NumberFormatter;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
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
        "nationality",
        "current_address",
        "religion",
        "nok",
        "nok_address",
        "nok_name",
        "nok_phone",
        "nok_relationship",
        "locked",
        "year_of_admission"
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

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'student_id');
    }

    public function getSemesterAttribute($value)
    {
        $formatter = new NumberFormatter('en-US', NumberFormatter::ORDINAL);
        return ucfirst($formatter->format($value));
    }
}
