<?php

namespace App;

use App\User;
use App\Faculty;
use App\Department;
use NumberFormatter;
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

    public function getSemesterAttribute($value)
    {
        $formatter = new NumberFormatter('en-US', NumberFormatter::ORDINAL);
        return ucfirst($formatter->format($value));
    }
}
