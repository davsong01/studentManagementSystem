<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    
    public function index()
    {
        $faculties = Faculty::with('departments')->get();
        return view('backend.results.index', compact('faculties'));
    }

    public function getDepartmentResults(Request $request)
    {
        if(!$request->department || !$request->faculty){
            return back()->with('warning', 'No Faculty or department selected');
        }
      
        $results = Result::with('faculty', 'department')->whereFacultyId($request->faculty)-> whereDepartmentId($request->department)->latest();

        if($request->p){
            $results->where('program', $request->p);
        }

        if ($request->l) {
            $results->where('level', $request->l);
        }

        if ($request->s) {
            $results->where('semester', $request->s);
        }

        if ($request->as) {
            $results->where('academic_session', $request->as);
        }

        if($results->count() < 1){
            return back()->with('warning', 'No data found, select other parameters');
        }

        $requests = $request->all();
        $results = $results->get();
       
        return view('backend.results.list', compact('requests','results'));
    }

    public function listResults(){
        $student = auth()->user()->student;
       
        $results = Result::whereUserId(auth()->user()->id)->whereStatus('published')->whereStudentId($student->id)->get();
        
        if(isset($results) && $results->count() < 1 ){
            return back()->with('warning','No results found!');
        }
     
        return view('dashboard.student.results', compact('results','student'));
    }

    public function singleResult($id){
      
        $result = Result::whereId($id)->first();
        $results = json_decode($result->courses);
        
        if (Auth::user()->hasRole('Admin')) {
            $student = $result->student;
            
            return view('dashboard.student.single-result-for-admin', compact('results', 'result', 'student'));
        }else{  
            return view('dashboard.student.single-result', compact('results', 'result'));
        }
       

    }


    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Result $result)
    {
        $pram = $request->param;
       
        return view('backend.results.single', compact('pram', 'result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        $courses = json_decode($result->courses, true);
        $total_score = [];
        $total_units = [];
        foreach($courses as $key=>$value){
            if(in_array($value['id'], array_keys($request->scores))){
                $courses[$key]['score'] = $request->scores[$value['id']];
                $total_score[] = $courses[$key]['score'];
                $total_units[] = $courses[$key]['units'];
            }
        }

        // Calulate gp
        $gp = $this->calculateGpa($courses, $result->maximum_units);
      
        // Get previous results for this user
        $cgpa = $this->calculateCgpa($result->student_id, $result->id);
       
        $result->update([
            'courses' => json_encode($courses),
            'weighted_point' =>  $gp['wp'],
            'gpa' => $gp['gp'],
            'cgpa' => number_format($cgpa, 2),
            'status' => 'published',
        ]);
       
        $param = base64_decode($request->pram);
        $param = json_decode($param, true);
        $param = http_build_query($param);
    
        return redirect(url('result-faculty?'.$param))->with('message', 'Result updated');
    }


    public function publishResult(Request $request){
        $result = Result::whereId($request->id)->first()->update([
            'status' => $request->status,
        ]); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        //
    }
}
