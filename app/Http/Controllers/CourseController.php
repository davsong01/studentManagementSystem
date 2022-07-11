<?php

namespace App\Http\Controllers;

use App\Course;
use App\Faculty;
use App\Teacher;

use App\Department;
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

    public function edit(Subject $subject)
    {
        $teachers = Teacher::latest()->get();

        return view('backend.courses.edit', compact('subject', 'teachers'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name'          => 'required|string|max:255|unique:courses,name,' . $subject->id,
            'subject_code'  => 'required|numeric',
            'teacher_id'    => 'required|numeric',
            'description'   => 'required|string|max:255'
        ]);

        $subject->update([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name),
            'subject_code'  => $request->subject_code,
            'teacher_id'    => $request->teacher_id,
            'description'   => $request->description
        ]);

        return redirect()->route('subject.index');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return back();
    }
}
