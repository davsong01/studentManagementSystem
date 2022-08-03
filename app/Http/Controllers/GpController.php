<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GpController extends Controller
{
    public function index(){
       
        $student = auth()->user()->student;
        return view('dashboard.student.gpcalculator', compact('student'));
    }

    public function process(Request $request){
        $courses = [];
        // $req = array_column($request->except(['_token']), 0);
        
        $req = $request->except(['_token']);
       
        for($i = 0; $i< count($request->code); $i++){
            $courses[] = array_column($request->except(['_token']), $i);
        }
        
        $c = [];
  
        foreach($courses as $course){
            $c[] = [
                'title' => $course[0],
                'units' => $course[1],
                'score' => $course[2],
            ];
        }
        
        $gp = $this->calculateGpa($c, array_sum(array_column($c, 'units')));
        $gp['units'] = array_sum(array_column($c, 'units'));
        
        \Session::put('courses', $c);
        \Session::put('gp', $gp);

        return back()->with('message', 'Operation successfull');
    }
}
