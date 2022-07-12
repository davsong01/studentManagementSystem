<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getSessions(){
        $years = range(date("Y"), 1993);
        return $years;
    }

    public function generateMatric($user)
    {
        $matric = 'ACU/' . 'NO' . date("Y"). '/'.'0'.$user->id;
        return $matric;
    }

}
