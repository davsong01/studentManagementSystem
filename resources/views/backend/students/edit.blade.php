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
        <img class="rounded-full mr-2 profile-avatar" src="{{ asset('images/profile/' . $student->user->profile_picture) }}" alt="Avatar">
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
           <span style="color:blue">Middle Name: </span>{{ $student->user->middlename ?? '--' }} <br>
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
<form autocomplete="off" action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('patch')
@include('backend.students.edit_form')
</form>
@endsection