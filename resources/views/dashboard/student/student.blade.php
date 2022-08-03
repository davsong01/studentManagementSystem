@extends('dashboard.student.index')
@section('page')
 <div class="col-md-9">
    <div class="row">
        <div class="col-md-12">
            <h3>Welcome {{ $student->user->name }}</h3>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" style="margin: 10px 0;">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('biodata.edit', $student->id) }}" class="text-green">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 text-center v-align py-4">
                                <img src="/images/user.svg"
                                    alt="user_icon" width="50px" height="50px">
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="card-block px-3 py-3">
                                    <p class="card-text">
                                        <b>Biodata</b><br>
                                        Complete/print your biodata details.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
         <div class="col-md-6" style="margin: 10px 0;">
            <div class="card">
                <div class="card-body">
                    @if(!app('App\Http\Controllers\Controller')->checkDuplicateResult($student))
                    <a href="{{ route('coursesform.edit', $student->id) }}" class="text-green">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 text-center v-align py-4">
                                <img src="/images/checklist2.svg"
                                    alt="user_icon" width="50px" height="50px">
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="card-block px-3 py-3">
                                    <p class="card-text">
                                        <b>Courses Form</b><br>
                                        Fill course form. <br><br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @else
                    <?php $course_form = app('App\Http\Controllers\Controller')->getCourseForm($student) ?>
                    <a href="{{ route('coursesform.view', $course_form->id) }}" class="text-green">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 text-center v-align py-4">
                                <img src="/images/checklist2.svg"
                                    alt="user_icon" width="50px" height="50px">
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="card-block px-3 py-3">
                                    <p class="card-text">
                                        <b>Courses Form</b><br>
                                        Print course form.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6" style="margin: 10px 0;">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('make-payments') }}" class="text-green">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 text-center v-align py-4">
                                <img src="/images/money_2.svg"
                                    alt="user_icon" width="50px" height="50px">
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <div class="card-block px-3 py-3">
                                    <p class="card-text">
                                        <b>Make payments</b><br>
                                        Make payments for school fees, department fees, etc.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div> --}}
        <div class="col-md-6" style="margin: 10px 0;">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('results.list') }}" class="text-green">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 text-center v-align py-4">
                                <img src="/images/result.svg"
                                    alt="user_icon" width="50px" height="50px">
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <div class="card-block px-3 py-3">
                                    <p class="card-text">
                                        <b>Print result</b><br>
                                        Print your results <br> <br> 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection