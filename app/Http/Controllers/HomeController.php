<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Grade;
use App\Models\Course;
use App\Models\Result;
use App\Models\Faculty;
use App\Models\Parents;
use App\Models\Student;
use App\Models\Teacher;

use App\Models\CourseForm;
use App\Models\Department;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
 
        if ($user->hasRole('Admin')) {
            $students = Student::latest()->get();
           
            return view('home', compact('students'));
        } elseif ($user->hasRole('Student')) {
           
            $student = Student::with(['user'])->findOrFail($user->student->id);
           
            return view('home', compact('student'));
        } else {
            return 'NO ROLE ASSIGNED YET!';
        }
    }

    /**
     * PROFILE
     */
    public function profile()
    {
        return view('profile.index');
    }

    public function profileEdit(Student $student)
    {
        $faculties = Faculty::latest()->get();
        $departments = Department::latest()->get();
        $years = $this->getSessions();
        $title = 'Edit biodata';
        return view('profile.edit', compact('student','faculties','departments','years','title'));
    }

    public function profileUpdate(Request $request, Student $student)
    {
       
        $data = $this->validate($request, [
            "name" => "required",
            "middlename" => "required",
            "surname" => "required",
            "password" => "nullable",
            "gender" => "required",
            "phone" => "required",
            "dateofbirth" => "required",
            "current_address" => "required",
            "nationality" => "required",
            "state_of_origin" => "required",
            "lga" => "required",
            "religion" => "required",
            "nok_name" => "required",
            "nok_phone" => "required",
            "nok_address" => "required",
            "nok_relationship" => "required",
        ]);
       
        if ($request->has('profile_picture')) {
            $imageName = uniqid(9) . '.' .  $request->profile_picture->getClientOriginalExtension();
            $request->profile_picture->move(public_path('images/profile'), $imageName);
            $data['profile_picture'] = $imageName;
        }

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = $student->user->password;
        }
        $data['locked'] = 1;
        $student->update($data);
        $student->user()->update([
            'name' => $data['name'],
            'profile_picture' => $data['profile_picture'] ??  $student->user->profile_picture,
            'surname' => $data['surname'],
            'middlename' => $data['middlename'],
            'password' => $data['password'],
        ]);
       
        return redirect()->route('home')->with('message', 'Operation successful');
    }

    public function viewCourseForm(Student $student){
       
        $c = CourseForm::whereProgram($student->program)
            ->whereLevel($student->level)
                ->whereSession(\App\Models\Setting::value('current_session'))
                    ->whereDepartmentId($student->department_id)
                        ->whereFacultyId($student->faculty_id)
                            ->whereSemester((int) $student->semester)
                            ->whereStatus('published')
                                ->first();
        $title = 'Course Form';
        
        $available = json_decode($c->available_courses);
        $maximum_unit = $c->maximum_units;
        return view('dashboard.student.course_form', compact('available','student','title','c', 'maximum_unit'));

    }

    public function updateCourseForm(Student $student, Request $request){
        // Check if student has previously filled course form for this semester
        if ($this->checkDuplicateResult($student)) {
            return back()->with('warning', 'You cannot select more than one course for this semster');
        }

        if(!$request->courses){
            return back()->with('warning', 'You must select at least one course to register');
        }
       
        $courses = [];
        $sum = 0;
        foreach ($request->courses as $course => $value) {
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
                'score' => 0,
            ];
        }

        $maximum_unit = CourseForm::whereId($request->id)->first();
        $maximum_unit = $maximum_unit->maximum_units;
        
        if($sum > $maximum_unit){
            return back()->with('warning', 'You cannot select courses of more than a cummulative of '.$maximum_unit);
        }
        Result::create([
            'user_id' => auth()->user()->id,
            'student_id' => $student->id,
            'courses' => json_encode($courses),
            'academic_session' => \App\Models\Setting::value('current_session'),
            'semester' => (int) $student->semester,
            'department_id' => $student->department_id,
            'faculty_id' => $student->faculty_id,
            'level' => $student->level,
            'program' => $student->program,
            'total_units' => $sum,
            'maximum_units' => $maximum_unit,
        ]);

        return redirect(route('home'))->with('message', 'Course form successfully submitted');
    }

    public function printCourseForm($id){
        $result = Result::find($id);
        $mycourses = json_decode($result->courses);
        
        return view('dashboard.student.print_course_form', compact('result', 'mycourses'));
    }

    public function singlePayment($id){
       
        $payment = Transaction::find($id);
       
        return view('dashboard.student.single-payment', compact('payment'));
    }
    public function changePasswordForm()
    {
        return view('profile.changepassword');
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('currentpassword'), Auth::user()->password))) {
            return back()->with([
                'msg_currentpassword' => 'Your current password does not matches with the password you provided! Please try again.'
            ]);
        }
        if (strcmp($request->get('currentpassword'), $request->get('newpassword')) == 0) {
            return back()->with([
                'msg_currentpassword' => 'New Password cannot be same as your current password! Please choose a different password.'
            ]);
        }

        $this->validate($request, [
            'currentpassword' => 'required',
            'newpassword'     => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        $user->password = bcrypt($request->get('newpassword'));
        $user->save();

        Auth::logout();
        return redirect()->route('login');
    }
    public function test(){
        $users = User::where('matric', '!=', '12345678')->get();
        
        $range = 1;

        foreach($users as $user){
            if($range < 25){
                $user->update([
                    'profile_picture' => $range ++ . '.jpg',
                ]);
            }
            
            $range ++;
            
        }

        dd('done');
    }
}
