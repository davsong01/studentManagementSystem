@extends('layouts.app')
@section('css')
<style>
    .text-green {
        text-decoration: none !important;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-4">
            <div class="card mb-4 shadow-sm">
                <img class="card-img-top"
                    src="{{ asset('images/profile/'.$student->user->profile_picture) }}"
                    alt="Card image cap" width="150px;" height="230px">
                <div class="card-body text-center">
                    <p class="card-text">
                        <a href="#"></a></p>
                    <h5><a href="#"><b><strong>{{ $student->user->matric }}</strong></b></a></h5>
                    <p></p>
                </div>
            </div>
            <div>
                <h6 class="">
                    <b>
                        {{ ucwords(auth()->user()->name) }} {{ ucwords(auth()->user()->surname) }} {{ ucwords(auth()->user()->name) }} <br>
                    </b>
                </h6>
                <small class="text-muted">{{ $student->program }} ({{ $student->department->name }})</small>
            </div>
            <hr>
            <div>
                <small>Academic session:</small><br>
                <b>{{ \App\Models\Setting::value('current_session') }}</b>
            </div>
            <br>
            <div>
                <small>Current semester:</small><br>
                <b>{{ strtoupper($student->semester )}} SEMESTER</b>
            </div>
            <br>
            <div>
                <small>Current level</small><br>
                <b>{{ $student->level }}00</b>
            </div>
            <br>
            <div>
                <small>Student status:</small><br>
                <b>{{ $student->level == 1 && (int) $student->semester == 1 ? 'FRESHER' : 'STALLITE' }}</b>
            </div>
            <br>
            
            <div>
                <small>Course registration status:</small><br>
                <b>NOT REGISTERED</b>
            </div>
            <br>
            
            <br>
            <br>
        </div>
       @yield('page')
    </div>
</div>
@endsection
