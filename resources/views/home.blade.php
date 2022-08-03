@extends('layouts.app')

@section('content')

<div class="home">
  

    @role('Admin')
        @include('dashboard.admin')
    @endrole

    @role('Parent')
        @include('dashboard.parents')
    @endrole

    @role('Teacher')
        @include('dashboard.teacher')
    @endrole

    @role('Student')
        @include('dashboard.student.student')
    @endrole

</div>

@endsection
