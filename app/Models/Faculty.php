<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Student;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $guarded = [];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
