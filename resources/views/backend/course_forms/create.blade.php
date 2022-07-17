@extends('layouts.app')
@section('css')
    <style>
        #available-courses{
            background: antiquewhite;
            padding: 10px;
        }
        
    </style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Prepare new course form</h2>
                <p style="color:blue">
                     NOTE: Fill the course details and then click the button to show available courses based on your selection

                </p>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('courseForm.index') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>
        <hr>
    </div>
</div>
<form action="{{ route('available.courses') }}" method="POST">
<div class="row">
    <div class="col-md-4">
        <div>
             <h5 style="display:inline-block;">Course Form details</h5>
            <hr>
        </div>
        @csrf
        <div class="form-group">
            <label for="session">Academic session</label>
            <select class="form-control" id="session" name="session" required>
                <option>Select</option>
                @foreach($years as $year=>$value)
                <option value="{{ ($value - 1). '/' .  $value }}" {{ old('session') == (($value - 1). '/' .  $value) ? 'selected' : '' }}>{{ ($value - 1). '/' .  $value }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="type">Select Program</label>
            <select class="form-control" id="program" name="program" {{ isset($faculty->departments) && $faculty->departments->count() < 1 ? 'disabled' : '' }}>
                <option value="">Select...</option>
                @foreach(app('App\Http\Controllers\Controller')->getPrograms() as $program)
                <option value="{{ $program }}">{{ $program }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="level">Select Level</label>
            <label for="type">Select Level</label>
            <select class="form-control" id="level" name="level" {{ isset($faculty->departments) && $faculty->departments->count() < 1 ? 'disabled' : '' }}>
                <option value="">Select...</option>
                @foreach(app('App\Http\Controllers\Controller')->getLevels() as $level)
                <option value="{{ $level }}">{{ $level }}00</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="program">Select Semester</label>
            <select class="form-control" id="semester" name="semester" required>
                <option value="">Select</option>
                <option value="1" {{ old('semester') == '1' ? 'selected' : ''}}>1st Semester</option>
                <option value="2" {{ old('semester') == '2' ? 'selected' : ''}}>2nd Semester</option>
            </select>
        </div>
        <div class="form-group">
            <label for="faculty">Select Department</label>
            <select class="form-control" id="department" name="department" required>
                <option value="">Select</option>
                @foreach($departments as $department)
                <option {{ (isset($department_id) && $department_id == $department->id) ? 'selected' : ''}} value="{{ $department->id }}" {{ $department->id == old('department') ? 'selected' : ''}}>{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="maximum_units">Maximum number of units</label>
            <input class="form-control" type="number" name="maximum_units" id="maximum_units" value="{{ $maximum_units ?? old('maximum_units')}}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
        </div>
    </div>
    <div class="col-md-8">
        <div>
            <h5 style="display:inline-block">Available Courses</h5>
            <hr>
            @include('layouts.alerts')
        </div>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Show available courses</button>
        
    </div>
</div>
</form>

@endsection
