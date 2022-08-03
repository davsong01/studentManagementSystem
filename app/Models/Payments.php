<?php

namespace App\Models;

use NumberFormatter;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $fillable = ['name', "faculty_id", "amount", "department_id", "program", "semester", "level", "status", "type"];

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
