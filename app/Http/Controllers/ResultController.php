<?php

namespace App\Http\Controllers;

use App\Result;
use App\Faculty;
use Illuminate\Http\Request;

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

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
    public function edit(Result $result)
    {
        //
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
        //
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
