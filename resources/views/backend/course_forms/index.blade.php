

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Courses Forms</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('courseForm.create') }}" class="btn btn-primary">
                    <span class="ml-2 text-xs font-semibold"> <i class="fa fa-plus"></i> Add new</span>
                </a>
            </div>
        </div>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table id="example" class="display" style="width:100%">
            <?php $i = 1; ?>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Session</th>
                <th>Faculty</th>
                <th>Semester</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courseForms as $course)
            <tr>
                <td>{{ $i++ }}</td>
                <td><strong>{{ $course->program }}, </strong>{{ $course->session }}, {{ $course->level }}00 level, <br>{{ $course->semester }} Semester</td>
                <td><small>@if($course->faculty && $course->department){{ $course->faculty->name }}, <br> Department of {{ $course->department->name }} @endif</small></td>
                <td>{{ $course->semester }} Semester</td>
               
                <td>
                    <a href="{{ route('courseForm.edit',$course->id) }}">
                       <button type="button" class="btn btn-primary btn-sm"> <i class="fa fa-pencil"></i> Edit</button>
                    </a>
                    <form onsubmit="confirm('This course form and all its courses will no longer be available to students')" action="{{ route('courseForm.destroy',$course->id) }}" method="POST" class="inline-flex ml-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete </button>
                    </form>
                </td>
            </tr>
            @endforeach
    </table>
    </div>
</div>
@endsection
