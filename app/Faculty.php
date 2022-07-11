<?php

namespace App;

use App\Student;
use App\Department;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $guarded = [];

    public function departments(){
        return $this->hasMany(Department::class);
    }

}
