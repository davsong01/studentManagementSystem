<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Faculty::withCount('departments')->latest()->get();
       
        return view('backend.faculties.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.faculties.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
        ]);

        Faculty::create($data);

        return redirect(route('faculty.index'))->with('message', 'Operation successful');
    }

    public function edit(Faculty $faculty)
    {
        return view('backend.faculties.edit', compact('faculty'));
    }

    public function update(Request $request, Faculty $faculty)
    {
        $data = $this->validate($request, [
            'name' => 'required',
        ]);

        $faculty->update($request->all());

        return redirect(route('faculty.index'))->with('message', 'Operation successful');
    }

    public function destroy(Faculty $faculty)
    {
        $faculty->delete();

        return redirect(route('faculty.index'))->with('message', 'Operation successful');
        
    }

    public function show(Faculty $faculty)
    {
        //
    }
}
