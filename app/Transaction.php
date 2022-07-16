<?php

namespace App;

use App\User;
use App\Faculty;
use App\Department;
use NumberFormatter;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
