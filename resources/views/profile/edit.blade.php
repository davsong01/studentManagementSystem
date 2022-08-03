@extends('dashboard.student.index')
@section('page')
 <div class="col-md-9">
    <div class="row">
        <div class="col-md-12">
            <h3>{{ $title ?? 'Welcome ' .$student->user->name}} </h3>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <form autocomplete="off" action="{{ route('biodata.save', $student->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        @include('backend.students.edit_form')
        </form>
        </div>
    </div>
</div>
@endsection