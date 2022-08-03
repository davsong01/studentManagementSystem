<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\Teacher;

use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('faculty', 'department')->latest()->get();
        return view('backend.courses.index', compact('courses'));
    }

    public function create()
    {
        $faculties = Faculty::latest()->get();
        $departments = Department::latest()->get();
        $years = $this->getSessions();

        return view('backend.courses.create', compact('faculties', 'departments', 'years'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'course_code' => 'required|string|max:255|unique:courses,course_code',
            "course_title" => "required",
            "faculty" => "required",
            "department" => "required",
            "program" => "required",
            "level" => "required",
            "units" => "required",
            "type" => "required",
            "semester" => "required|numeric"
        ]);
        $data['department_id'] = $request->department;
        $data['faculty_id'] = $request->faculty;
        Course::create($data);

        return redirect()->route('course.index')->with('message', 'Operation successful');
    }

    public function show(Subject $subject)
    {
        //
    }

    public function edit(Course $course)
    {
        $faculties = Faculty::latest()->get();
        $departments = Department::latest()->get();
        $years = $this->getSessions();

        return view('backend.courses.edit', compact('faculties','departments','years','course'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $this->validate($request, [
            'course_code' => 'required|string|max:255|unique:courses,course_code,' . $course->id,
            "course_title" => "required",
            "faculty" => "required",
            "department" => "required",
            "program" => "required",
            "level" => "required",
            "units" => "required",
            "type" => "required",
            "semester" => "required|numeric"
        ]);
        
        $data['department_id'] = $request->department;
        $data['faculty_id'] = $request->faculty;

        $course->update($data);

        return redirect()->route('course.index')->with('message', 'Operation successful');

    }

    public function destroy(Course $course)
    {
        $course->delete();
        return back()->with('message', 'Operation succesful');
    }
}
