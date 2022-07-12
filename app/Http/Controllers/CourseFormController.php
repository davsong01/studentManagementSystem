<?php

namespace App\Http\Controllers;

use App\Course;
use App\Faculty;
use App\CourseForm;
use App\Department;
use NumberFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CourseFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courseForms = CourseForm::with('faculty', 'department')->latest()->get();
        
        return view('backend.course_forms.index', compact('courseForms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = Faculty::whereHas('courses')->latest()->get();
        $departments = Department::whereHas('courses')->latest()->get();
        $years = $this->getSessions();
      
        // $unfinished = CourseForm::whereNULL('available_courses')->get();
        // if($unfinished && $unfinished->count() > 0){
        //     $unfinished->delete();
        // }
        
        return view('backend.course_forms.create', compact('faculties', 'departments', 'years'));
    }

    public function showAvailableCourses(Request $request)
    {
        $program = $request->program;
        $level = $request->level;
        $semester = $request->semester;
        $department = $request->department;
        $maximum_units = $request->maximum_units;
       
        $faculty_id = Department::with('faculty')->whereId($request->department)->first()->faculty->id;

        $unfinished = CourseForm::whereNULL('available_courses')->first();

        if($unfinished){
            $unfinished->delete();
        }
        $newForm = CourseForm::create([
            'program' => $program,
            'level' => $request->level,
            'session' => $request->session,
            'department_id' => $department,
            'faculty_id' => $faculty_id,
            'semester' => $semester,
            'maximum_units' => $maximum_units,
        ]);

        $available = Course::whereProgram($program)
            ->whereLevel($level)
                -> whereSemester($semester)
                    ->whereProgram($program)
                    ->whereDepartmentId($department)
                        ->whereFacultyId($faculty_id)
                                ->latest()
                                    ->get();

        if(!isset($available) || $available->count() < 1){
            return back()->with('error', 'No available courses for the selected parameters, Please add new course');
        }
        $faculty = Faculty::whereId('$faculty_id')->value('name');
        $department = Department::whereId($newForm->department_id)->value('name');
        $formatter = new NumberFormatter('en-US', NumberFormatter::ORDINAL);
        $semester = ucfirst($formatter->format($semester));
       
        return view('backend.course_forms.create2')
            ->with('available', $available)
            ->with('program', $newForm->program)
            ->with('id', $newForm->id)
            ->with('level', $newForm->level.'00')
            ->with('session', $newForm->session)
            ->with('program', $newForm->program)
            ->with('semester', $semester)
            ->with('faculty', $faculty)
            ->with( 'department', $department)
            ->with('maximum_units', $newForm->maximum_units);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'courses' => 'required',
            
        ]);
       
        $courses = [];

        foreach($request->courses as $course=>$value){
            $d = Course::whereId($value)->first();
            $title = $d->course_title;
            $code = $d->course_code;
            $units = $d->units;

            $courses[] = [
                'title' => $title,
                'code' => $code,
                'units' => $units,
            ];
        }
       
        // Check if course form with same department, semester, level and program exists
        CourseForm::whereId($request->id)->update([
            'available_courses' => json_encode($courses)
        ]);
        
        return redirect(route('courseForm.index'))->with('message', 'Operation successful');
    }

    public function show(CourseForm $courseForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CourseForm  $courseForm
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseForm $courseForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CourseForm  $courseForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseForm $courseForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CourseForm  $courseForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseForm $courseForm)
    {
        //
    }
}
