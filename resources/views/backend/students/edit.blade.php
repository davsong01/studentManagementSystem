@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Edit student details</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('student.index') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>
        <hr>
    </div>
</div>
<div class="row" style="padding:20px 0">
    <div class="col-md-2">
        <img class="rounded-full mr-2 profile-avatar" src="{{ asset('images/profile/' . auth()->user()->profile_picture) }}" alt="Avatar">
    </div>
    <div class="col-md-2">
       <strong class="profile-heading">Matric Number</strong>
        <p class="profile-value"> <span class="m" style="color:green; font-weight:bolder">{{ $student->user->matric ?? '--' }} </span><br>
            <strong>{{ $student->program }}, </strong>{{ $student->level }}00 level, <br>{{ $student->semester }} Semester
        </p>
       
    </div>
    <div class="col-md-4">
        <strong class="profile-heading">Full names</strong>
        <p class="profile-value">
           <span style="color:blue">First Name: </span>{{ $student->user->name }} <br>
           <span style="color:blue">Middle Name: </span>{{ $student->user->middle_name?? '--' }} <br>
           <span style="color:blue">Surname: </span>{{ $student->user->surname ?? '--' }} <br>
        </p>
    </div>
    <div class="col-md-2">
        <strong class="profile-heading">Email</strong>
        <p class="profile-value">{{ $student->user->email }}</p>
         <strong class="profile-heading">Phone</strong>
        <p class="profile-value">{{ $student->phone }}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h4 style="color:blue">Personal details</h4>
        <hr>
        <form autocomplete="off" action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" value="{{ old('name') ?? $student->user->name }}" name="name" placeholder="Enter student's name">
            </div>
            <div class="form-group">
                <label for="middle_name">Middlename</label>
                <input type="text" class="form-control" id="middle_name" value="{{ old('middle_name') ?? $student->user->middle_name }}" name="middle_name" placeholder="Enter student's middle name"  >
            </div>
            <div class="form-group">
                <label for="surname">Surname</label>
                <input type="text" class="form-control" id="surname" value="{{ old('surname') ?? $student->user->surname }}" name="surname" placeholder="Enter surname"  >
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" value="{{ old('email') ?? $student->user->email }}" name="email" placeholder="Enter email"  >
            </div>
            
            <div class="form-group">
                <label for="password">Password <span style="color:blue">(Leave blank to use surname as password)</span></label>
                <input type="password" value="{{ old('password') }}" class="form-control" id="password" name="password" placeholder="Enter password">
            </div>
            <div class="form-group">
                <label for="profile_picture">Replace picture</label>
                <input type="file" class="form-control" id="profile_picture" value="{{ old('profile_picture') }}" name="profile_picture">
            </div>
    </div>

    <div class="col-md-6">
        <h4 style="color:blue">Academic details</h4>
        <hr>
        <div class="form-group">
            <label for="program">Select Program</label>
            <select class="form-control" id="program" name="program" required>
                <option>Select</option>
                <option value="PRE-DEGREE" {{ $student->program == 'PRE-DEGREE' ? 'selected' : ''}}>PRE DEGREE</option>
                <option value="BSC" {{ $student->program == 'BSC' ? 'selected' : ''}}>BSC</option>
                <option value="MASTERS" {{ $student->program == 'MASTERS' ? 'selected' : ''}}>MASTERS</option>
                <option value="PHD" {{ $student->program == 'PHD' ? 'selected' : ''}}>PHD</option>
            </select>
        </div>
        <div class="form-group">
            <label for="level">Select Current Level</label>
            <select class="form-control" id="level" name="level" required>
                <option>Select</option>
                <option value="1" {{ $student->level == '1' ? 'selected' : ''}}>Level 1</option>
                <option value="2" {{ $student->level == '2' ? 'selected' : ''}}>Level 2</option>
                <option value="3" {{ $student->level == '3' ? 'selected' : ''}}>Level 3</option>
                <option value="4" {{ $student->level == '4' ? 'selected' : ''}}>Level 4</option>
                <option value="5" {{ $student->level == '5' ? 'selected' : ''}}>Level 5</option>
            </select>
        </div> 
        <div class="form-group">
            <label for="program">Select Semester</label>
            <select class="form-control" id="semester" name="semester" required>
                <option value="">Select</option>
                <option value="1" {{  (int) $student->semester == '1' ? 'selected' : ''}}>1st Semester</option>
                <option value="2" {{  (int) $student->semester == '2' ? 'selected' : ''}}>2nd Semester</option>
            </select>
        </div>
        <div class="form-group">
            <label for="faculty">Select Department</label>
            <select class="form-control" id="department" name="department" required>
                <option value="">Select</option>
                @foreach($departments as $faculty)
                <option value="{{ $faculty->id }}" {{ $faculty->id == $student->department_id ? 'selected' : ''}}>{{ $faculty->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <h4 style="color:blue">Other details</h4>
        <hr>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select class="form-control" id="gender" name="gender">
                <option value="">Select</option>
                <option value="male" {{ $student->gender == 'male' ? 'selected' : ''}}>Male</option>
                <option value="female" {{ $student->gender == 'female' ? 'selected' : ''}}>Female</option>    
            </select>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="phone" class="form-control" id="phone" value="{{ old('phone') ?? $student->phone }}" name="phone" placeholder="Enter phone number">
        </div>
        <div class="form-group">
            <label for="dateofbirth">Date of birth</label>
            <input type="date" class="form-control" id="dateofbirth" value="{{ old('dateofbirth') ?? $student->dateofbirth }}" name="dateofbirth">
        </div>
        <div class="form-group">
            <label for="current_address">Current address</label>
            <textarea name="current_address" id="" rows="4" class="form-control" id="current_address" value="{{ old('current_address') ?? $student->current_address }}">{{ old('current_address') ?? $student->current_address }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
         
        <div class="form-group top" style="margin-top:53px">
            <label for="nationality">Nationality</label>
            <select class="form-control" id="nationality" name="nationality">
                <option value="">Select</option>
                <option value="nigeria" {{ $student->nationality == 'nigeria' ? 'selected' : ''}}>Nigeria</option>
                <option value="international" {{ $student->nationality == 'international' ? 'selected' : ''}}>International</option>    
            </select>
        </div>
        <div class="form-group">
            <label for="state_of_origin">State of Origin</label>
            <input type="text" class="form-control" id="state_of_origin" value="{{ old('state_of_origin') ?? $student->state_of_origin }}" name="state_of_origin">
        </div>
        <div class="form-group">
            <label for="lga">Lga</label>
            <input type="text" class="form-control" id="lga" value="{{ old('lga') ?? $student->lga }}" name="lga">
        </div>
        <div class="form-group">
            <label for="religion">Religion</label>
            <input type="text" class="form-control" id="religion" value="{{ old('religion') ?? $student->religion}}" name="religion">
        </div>
    </div>
    <div class="col-md-12">
        <h4 style="color:blue">Next of Kin details</h4>
        <hr>
            <div class="form-group">
                <label for="nok_name">Next of kin name</label>
                <input type="nok_name" class="form-control" id="nok_name" value="{{ old('nok_name') ?? $student->nok_name }}" name="nok_name" placeholder="Enter next of kin name">
            </div>
            <div class="form-group">
                <label for="nok_phone">Next of kin phone</label>
                <input type="nok_phone" class="form-control" id="nok_phone" value="{{ old('nok_phone') ?? $student->nok_phone }}" name="nok_phone" placeholder="Enter phone number">
            </div>
            <div class="form-group">
                <label for="nok_name">Next of kin address</label>
                <textarea class="form-control" name="nok_address" id="nok_address" rows="3">{{ old('nok_address') ?? $student->nok_address }}</textarea>
            </div>
            <div class="form-group top">
            <label for="gender">Nexk of kin relationship</label>
            <select class="form-control" id="nok_relationship" name="nok_relationship">
                <option value="">Select relationship</option>
                <option value="father" {{ $student->nok_relationship == 'father' ? 'selected' : ''}}>Father</option>
                <option value="mother" {{ $student->nok_relationship == 'mother' ? 'selected' : ''}}>Mother</option>
                <option value="sister" {{ $student->nok_relationship == 'sister' ? 'selected' : ''}}>Sister</option>
                <option value="brother" {{ $student->nok_relationship == 'brother' ? 'selected' : ''}}>Brother</option>
                <option value="uncle" {{ $student->nok_relationship == 'uncle' ? 'selected' : ''}}>Uncle</option>
                <option value="aunt" {{ $student->nok_relationship == 'aunt' ? 'selected' : ''}}>Aunt</option>
            </select>
            </div>
        </div>
    </div>
     
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary" style="width: 100%">Submit</button>
    </div>
            
    </form>
    </div>
</div>
@endsection