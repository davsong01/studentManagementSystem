@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Upload results</h2>
            </div>
        </div>
        <hr>
    </div>
</div>
<div class="row">
    @foreach($faculties as $faculty)
    <div class="col-md-4" style="margin-bottom: 20px;">
        <div class="card">
            <div class="card">
                <h5 class="card-header" style="font-weight: bold">{{ ucwords($faculty->name) }}</h5>
                <form action="{{ route('result.faculty') }}" method="get">
                
                <div class="card-body">
                    <div class="form-group">
                    <label for="type">Select Department<span class="required">*</span></label>
                        <select class="form-control" id="department" name="department" required>
                            @if(isset($faculty->departments) && $faculty->departments->count() > 0)
                            @foreach($faculty->departments as $department)
                            <option value="{{ $department->id }}" {{ old('department') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                            @endforeach
                            @else
                            <option value="">No department found</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="type">Select Program</label>
                        <select class="form-control" id="p" name="p" {{ isset($faculty->departments) && $faculty->departments->count() < 1 ? 'disabled' : '' }}>
                            <option value="">Select...</option>
                            @foreach(app('App\Http\Controllers\Controller')->getPrograms() as $program)
                            <option value="{{ $program }}">{{ $program }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="type">Select Level</label>
                        <select class="form-control" id="l" name="l" {{ isset($faculty->departments) && $faculty->departments->count() < 1 ? 'disabled' : '' }}>
                            <option value="">Select...</option>
                            @foreach(app('App\Http\Controllers\Controller')->getLevels() as $level)
                            <option value="{{ $level }}">{{ $level }}00</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="type">Select Semester</label>
                        <select class="form-control" id="s" name="s" {{ isset($faculty->departments) && $faculty->departments->count() < 1 ? 'disabled' : '' }}>
                            <option value="">Select...</option>
                            @foreach(app('App\Http\Controllers\Controller')->getSemesters() as $semester)
                            <option value="{{ $semester }}">{{ $semester }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="type">Select Academic session</label>
                        <select class="form-control" id="as" name="as" {{ isset($faculty->departments) && $faculty->departments->count() < 1 ? 'disabled' : '' }}>
                            <option value="">Select...</option>
                            @foreach(app('App\Http\Controllers\Controller')->getSessions() as $sessions)
                            <option value="{{ $sessions }}/{{ $sessions + 1 }}">{{ $sessions }}/{{ $sessions + 1 }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" value="{{ $faculty->id }}" name="faculty">
                    <button type="submit" class="btn btn-primary" {{ isset($faculty->departments) && $faculty->departments->count() < 1 ? 'disabled' : '' }}><i class="fa fa-sign-in"></i> Start upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
