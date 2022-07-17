

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Students</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('student.create') }}" class="btn btn-primary">
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
                <th>Matric</th>
                <th>Avatar</th>
                <th>Details</th>
                <th>Program</th>
                <th>GPA</th>
                <th>CGPA</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $student->user->matric }}</td>
                <td>
                    <img class="rounded-full mr-2 profile-avatar" style="width: 80px;height:80px" src="{{ asset('images/profile/' . $student->user->profile_picture) }}" alt="Avatar">
                <td>
                    <b>Name: </b>{{ $student->user->name ?? '--'. ' ' . $student->user->surname ?? '--' }} <br>
                    <b>Email: </b>{{ $student->user->email ?? '--'}} <br>
                    {{-- <b>Matric No: </b>{{ $student->user->matric  ?? '--' }}  <br> --}}
                    <b>Current level: </b>Level {{ $student->level.'00'  }}, {{ $student->semester }} Semester
                </td>
                <td> 
                    <b>Program: </b>{{ $student->program }}  <br>
                    <b>Faculty: </b>{{ $student->faculty->name ?? '--' }}  <br>
                    <b>Department: </b>{{ $student->department->name ?? '--' }}  <br>
                </td>
                <td>{{ $student->gpa ?? '--' }}</td>
                <td>{{ $student->cgpa ?? '--' }}</td>
                <td>
                    <a href="{{ route('student.edit',$student->id) }}">
                       <button type="button" class="btn btn-primary btn-sm" style="margin-bottom: 3px;"> <i class="fa fa-pencil"></i> Edit</button>
                    </a>
                    <br>
                    <form action="{{ route('course.destroy',$student->id) }}" method="POST" class="inline-flex ml-1">
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
