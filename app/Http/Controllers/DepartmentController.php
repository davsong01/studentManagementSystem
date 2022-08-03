<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('students')->latest()->get();

        return view('backend.departments.index', compact('departments'));
    }

    public function create()
    {
        $faculties = Faculty::latest()->get();

        return view('backend.departments.create', compact('faculties'));
    }

    public function store(Request $request)
    {
        
        $data = $this->validate($request, [
            'name' => 'required',
            'faculty' => 'required',
        ]);

        $data['faculty_id'] = $data['faculty'];
        Department::create($data);

        return redirect(route('department.index'))->with('message', 'Operation successful');
    }

    public function show(Department $department)
    {
        //
    }

    public function edit(Department $department)
    {
        $faculties = Faculty::latest()->get();

        return view('backend.departments.edit', compact('department', 'faculties'));
    }

    public function update(Request $request, Department $department)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'faculty' => 'required',
        ]);
        $data['faculty_id'] = $data['faculty'];
        $department->update($request->all());

        return redirect(route('department.index'))->with('message', 'Operation successful');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect(route('department.index'))->with('message', 'Operation successful');
    }
}
