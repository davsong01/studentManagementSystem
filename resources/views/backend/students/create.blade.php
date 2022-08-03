@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Add new student</h2>
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
<div class="row">
    <div class="col-md-6">
        <h4 style="color:blue">Personal details</h4>
        <hr>
        <form autocomplete="off" action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name" placeholder="Enter student's name" required>
            </div>
            <div class="form-group">
                <label for="name">Middle name</label>
                <input type="text" class="form-control" id="middlename" value="{{ old('middlename') }}" name="middlename" placeholder="Enter student's middlename" required>
            </div>
            <div class="form-group">
                <label for="surname">Surname</label>
                <input type="text" class="form-control" id="surname" value="{{ old('surname') }}" name="surname" placeholder="Enter surname" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" value="{{ old('email') }}" name="email" placeholder="Enter email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password <span style="color:blue">(Leave blank to use surname as password)</span></label>
                <input type="password" value="{{ old('password') }}" class="form-control" id="password" name="password" placeholder="Enter password">
            </div>
            <div class="form-group">
                <label for="profile_picture">Profile picture</label>
                <input type="file" class="form-control" id="profile_picture" value="{{ old('profile_picture') }}" name="profile_picture">
            </div>
    </div>

    <div class="col-md-6">
        <h4 style="color:blue">Academic details</h4>
        <hr>
        <div class="form-group">
            <label for="type">Year of Admission</label>
            <select class="form-control" id="as" name="year_of_admission" required>
                <option value="">Select...</option>
                @foreach(app('App\Http\Controllers\Controller')->getSessions() as $sessions)
                <option value="{{ $sessions }}/{{ $sessions + 1 }}">{{ $sessions }}/{{ $sessions + 1 }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="program">Select Program</label>
            <select class="form-control" id="program" name="program">
                <option>Select</option>
                @foreach(app('App\Http\Controllers\Controller')->getPrograms() as $program)
                <option value="{{ $program }}" {{ old('program') == $program ? 'selected' : '' }}>{{ $program }}</option>
                @endforeach
                
            </select>
        </div>
        <div class="form-group">
            <label for="level">Select Current Level</label>
            <select class="form-control" id="level" name="level">
                <option>Select</option>
                <option value="1">Level 1</option>
                <option value="2">Level 2</option>
                <option value="3">Level 3</option>
                <option value="4">Level 4</option>
                <option value="5">Level 5</option>
            </select>
        </div> 
        <div class="form-group">
            <label for="program">Select Semester</label>
            <select class="form-control" id="semester" name="semester">
                <option>Select</option>
                <option value="1">1st Semester</option>
                <option value="2">2nd Semester</option>
            </select>
        </div>
        <div class="form-group">
            <label for="faculty">Select Department</label>
            <select class="form-control" id="department" name="department">
                <option>Select</option>
                @foreach($departments as $faculty)
                <option value="{{ $faculty->id }}" {{ $faculty->id == old('department') ? 'selected' : ''}}>{{ $faculty->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <h4 style="color:blue">Other details</h4>
        <hr>
        <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>    
                </select>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="phone" class="form-control" id="phone" value="{{ old('phone') }}" name="phone" placeholder="Enter phone number">
            </div>
            <div class="form-group">
                <label for="dateofbirth">Date of birth</label>
                <input type="date" class="form-control" id="dateofbirth" value="{{ old('dateofbirth') }}" name="dateofbirth">
            </div>
            <div class="form-group">
                <label for="current_address">Current address</label>
                <input type="text" class="form-control" id="current_address" value="{{ old('current_address') }}" name="current_address">
            </div>
            
            <div class="form-group">
                <label for="state_of_origin">State of Origin</label>
                <input type="text" class="form-control" id="state_of_origin" value="{{ old('state_of_origin') }}" name="state_of_origin">
            </div>
            <div class="form-group">
                <label for="lga">Lga</label>
                <input type="text" class="form-control" id="lga" value="{{ old('lga') }}" name="lga">
            </div>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary" style="width: 100%">Submit</button>
    </div>
            
    </form>
    </div>
</div>
@endsection