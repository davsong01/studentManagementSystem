<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\CourseForm;
use App\Models\Department;
use NumberFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CourseFormController extends Controller
{
   
    public function index()
    {
        $courseForms = CourseForm::with('faculty', 'department')->latest()->get();
        
        return view('backend.course_forms.index', compact('courseForms'));
    }

    public function create()
    {
        $faculties = Faculty::whereHas('courses')->latest()->get();
        $departments = Department::whereHas('courses')->latest()->get();
        $years = $this->getSessions();
      
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
            'status' => $request->status,
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

    public function store(Request $request)
    {
      
        $this->validate($request, [
            'courses' => 'required',
        ]);
        // dd($request->all());
        $courses = [];
        $sum = 0;
        foreach($request->courses as $course=>$value){
            $d = Course::whereId($value)->first();
            $id = $d->id;
            $title = $d->course_title;
            $code = $d->course_code;
            $units = $d->units;
            $type = $d->type;
            $sum += $d->units;
            $courses[] = [
                'id' => $id,
                'title' => $title,
                'code' => $code,
                'units' => $units,
                'type' => $type,
            ];
        }
        // Check if maximum units = selected courses
        if($request->maximum_units != $sum){
            return redirect(route('courseForm.index'))->with('error', 'Selected course units does not match maximum units entered, please edit and try again');
        }
        // Check if course form with same department, semester, level and program exists
        CourseForm::whereId($request->id)->update([
            'available_courses' => json_encode($courses),
            'maximum_units' => $sum,
        ]);
        
        return redirect(route('courseForm.index'))->with('message', 'Operation successful');
    }

    public function edit(CourseForm $courseForm)
    {
        $available = Course::whereProgram($courseForm->program)
            ->whereLevel($courseForm->level)
            ->whereSemester((int) $courseForm->semester)
            ->whereDepartmentId($courseForm->department_id)
            ->whereFacultyId($courseForm->faculty_id)
            ->latest()
            ->get();

        $selected = [];
        $selected = isset($courseForm->available_courses) ? json_decode($courseForm->available_courses, true) : [];
        $total = !empty($selected) ? array_sum(array_column($selected, 'units')) : 0;
        $faculty = Faculty::whereId('$faculty_id')->value('name');
        $department = Department::whereId($courseForm->department_id)->value('name');
        if(!isset($selected)){
            $faculties = Faculty::whereHas('courses')->latest()->get();
            $departments = Department::whereHas('courses')->latest()->get();
            $years = $this->getSessions();

            return view('backend.course_forms.create', compact('faculties', 'departments', 'years'));
        }
        
        if(count($selected) > 0){
            $selected = array_values(array_column($selected, 'id'));
        }  
        
        return view('backend.course_forms.create2')
        ->with('available', $available)
            ->with('program', $courseForm->program)
            ->with('id', $courseForm->id)
            ->with('level', $courseForm->level . '00')
            ->with('session', $courseForm->session)
            ->with('program', $courseForm->program)
            ->with('semester', $courseForm->semester)
            ->with('faculty', $faculty)
            ->with('department', $department)
            ->with('selected', $selected)
            ->with('maximum_units', $courseForm->maximum_units)
            ->with('total', $total);
    }

    public function show(CourseForm $courseForm)
    {
        //
    }

  
    public function update(Request $request, CourseForm $courseForm)
    {
        
    }

    public function destroy(CourseForm $courseForm)
    {
        $courseForm->delete();
        return back()->with('message', 'Operation successfull');
    }
}
