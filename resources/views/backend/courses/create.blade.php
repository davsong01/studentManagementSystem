@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Add new course</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('department.index') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('course.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="course_title">Course Title</label>
                <input type="text" class="form-control" id="name" value="{{ old('course_title') }}" name="course_title" placeholder="Enter course title" required>
            </div>
            <div class="form-group">
                <label for="name">Course Code</label>
                <input type="text" class="form-control" id="name" value="{{ old('course_code') }}" name="course_code" placeholder="Enter course code" required>
            </div>
            <div class="form-group">
                <label for="units">Course Units</label>
                <input type="number" min="0" class="form-control" id="unit" value="{{ old('units') }}" name="units" placeholder="Enter course units" required>
            </div>
            <div class="form-group">
                <label for="type">Course Type</label>
                <select class="form-control" id="type" name="type">
                    <option>Select</option>
                    <option value="C" {{ old('type') == 'C' ? 'selected' : '' }}>Core</option>
                    <option value="E" {{ old('type') == 'E' ? 'selected' : '' }}>Elective</option>
                    <option value="G" {{ old('type') == 'G' ? 'selected' : '' }}>General</option>
                </select>
            </div>
            <div class="form-group">
                <label for="faculty">Select Faculty</label>
                <select class="form-control" id="faculty" name="faculty">
                    <option>Select</option>
                    @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}" {{ $faculty->id == old('faculty') ? 'selected' : ''}}>{{ $faculty->name }}</option>
                    @endforeach
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
            <div class="form-group">
                <label for="program">Select Program</label>
                <select class="form-control" id="program" name="program">
                    <option>Select</option>
                    <option value="PRE-DEGREE">PRE DEGREE</option>
                    <option value="BSC">BSC</option>
                    <option value="MASTERS">MASTERS</option>
                    <option value="PHD">PHD</option>
                </select>
            </div>
            <div class="form-group">
                <label for="level">Select Level</label>
                <select class="form-control" id="level" name="level">
                    <option>Select</option>
                    @foreach(app('App\Http\Controllers\Controller')->getLevels() as $level)
                    <option value="{{ $level }}">{{ $level }}00</option>
                    @endforeach
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
                <label for="program">General course?</label>
                <select class="form-control" id="general" name="general">
                    <option value="no" selected>No</option>
                    <option value="yes">Yes</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection