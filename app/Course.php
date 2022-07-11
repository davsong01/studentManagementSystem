<?php

namespace App;

use App\Faculty;
use App\Department;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['course_code',"course_title","faculty_id","department_id","program","semester", "level"];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}
