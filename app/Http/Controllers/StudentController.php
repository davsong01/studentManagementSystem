<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Grade;
use App\Models\Faculty;
use App\Models\Parents;
use App\Models\Student;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('department')->latest()->get();
        
        return view('backend.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = Faculty::latest()->get();
        $departments = Department::latest()->get();
        $years = $this->getSessions();
        
        return view('backend.students.create', compact('faculties', 'departments','years'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'nullable',
            'program' => 'sometimes',
            'level' => 'required',
            'gender' => 'required',
            'phone' => 'required|max:255',
            'semester' => 'required|max:255',
            'dateofbirth' => 'nullable|date',
            'current_address' => 'nullable|max:255',
            "state_of_origin" => 'nullable|string',
            "lga" => 'nullable',
            "year_of_admission" => 'nullable'
        ]);
        
        if ($request->profile_picture) {
            $imageName = uniqid(9) . '.' .  $request->profile_picture->getClientOriginalExtension();
            $request->profile_picture->move(public_path('images/profile'), $imageName);
            $profile = $imageName;
        }

        $data['faculty_id'] = Department::with('faculty')->whereId($request->department)->first()->faculty->id;

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = Hash::make(strtoupper($request->surname));
        }
        $data['profile'] = $profile;
       
        try {
            $user = User::create($data);

            $data['matric'] = $this->generateMatric($user);
            $user->update(['matric' => $data['matric']]);
            $data['department_id'] = $request->department;

            $user->student()->create($data);

            $user->assignRole('Student');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
        
       
        return redirect()->route('student.index')->with('message', 'Operation successful');
    }
    
    public function show(Student $student)
    {
        $class = Grade::with('courses')->where('id', $student->class_id)->first();

        return view('backend.students.show', compact('class', 'student'));
    }

    public function edit(Student $student)
    {
        $faculties = Faculty::latest()->get();
        $departments = Department::latest()->get();
        $years = $this->getSessions();

        return view('backend.students.edit', compact('student', 'faculties', 'departments', 'years'));
    }
    
    public function update(Request $request, Student $student)
    {
        // dd($request->all());

        if ($request->profile_picture) {
            $imageName = uniqid(9) . '.' .  $request->profile_picture->getClientOriginalExtension();
            $request->profile_picture->move(public_path('images/profile'), $imageName);
            $request['profile_picture'] = $imageName;
        }
      
        $request['faculty_id'] = Department::with('faculty')->whereId($request->department)->first()->faculty->id;
        if ($request->password) {
            $request['password'] = Hash::make($request->password);
        } else{
             $request['password'] = $student->user->password;
        }

        $request['department_id'] = $request->department;

        $student->user()->update($request->only(['name', 'email', 'password', 'profile_picture', 'surname', 'matric']));
       
        $student->update($request->only([
            'gender',
            'phone',
            'dateofbirth',
            'current_address',
            "program",
            "level",
            "semester",
            "department_id",
            "faculty_id",
            "state_of_origin",
            "matric",
            "lga",
            "nationality",
            "religion",
            "nok",
            "nok_address",
            "nok_name",
            "nok_phone",
            "nok_relationship",
            "year_of_admission"
        ]));
      
        return redirect()->route('student.index')->with('message', 'Operation successful');
    }

    public function destroy(Student $student)
    {
        $user = User::findOrFail($student->user_id);
        $user->student()->delete();
        $user->removeRole('Student');

        if ($user->delete()) {
            if ($user->profile_picture != 'avatar.png') {
                $image_path = public_path() . '/images/profile/' . $user->profile_picture;
                if (is_file($image_path) && file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        }

        return back();
    }
}
