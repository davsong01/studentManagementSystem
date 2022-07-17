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
<form action="{{ route('courseForm.store') }}" onSubmit="return confirm('This course form will be available to students');" method="POST">
<div class="row">
    <div class="col-md-4">
        <div>
             <h5 style="display:inline-block;">Course Form details</h5>
            <hr>
        </div>
        @csrf
        <div class="form-group">
            <label for="session">Academic session</label>
            <select class="form-control" id="session" name="session" readonly>
                <option>{{ $session }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="program">Select Program</label>
            <select class="form-control" id="program" name="program" readonly>
                <option>{{ $program }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="level">Select Level</label>
            <select class="form-control" id="level" name="level" readonly>
                <option>{{ $level }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="program">Select Semester</label>
            <select class="form-control" id="semester" name="semester" readonly>
                <option>{{ $semester }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="department">Select Department</label>
            <select class="form-control" id="department" name="department" readonly>
                <option value="{{ $department }}">{{ $department }}</option>
               
            </select>
        </div>
        <div class="form-group">
            <label for="maximum_units">Maximum number of units</label>
            <input class="form-control" type="number" name="maximum_units" id="maximum_units" value="{{ $maximum_units}}">
        </div>
    </div>
    <div class="col-md-8">
        <div>
             <h5 style="display:inline-block">Available Courses</h5>
            <hr>
            <div>
                <label style="padding:10px"> <strong>Total Units selected: <span id="total">{{ $total ?? 0}}</span> </strong> </label>
            </div>
            <div id="available-courses">
                <div class="row">
                    @if(isset($available) && $available->count() > 0)
                    @foreach($available as $course)
                    <div class="col-md-6">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input courses" id="{{ $course->id }}" name="courses[]" value="{{ $course->id }}" {{ isset($selected) && in_array($course->id, $selected) ? 'checked' : ''}}>
                            <label class="form-check-label" for="{{ $course->id }}">{{ $course->course_title }} | 
                                <span style="color:blue">{{ $course->course_code }}</spamn> | 
                                <span style="color:red">{{ $course->units }}units</span> | 
                                <span style="color:green">{{ $course->type }}</span>
                            </label>
                        </div>
                    </div>
                    <script>
                        $("#{{ $course->id }}").change(function() {
                            var total = parseInt($("#total").text());
                            if(this.checked) {
                                total += {{ $course->units }};
                            console.log(total); //Do stuff
                            }else{
                                total -= {{ $course->units }};
                            }
                            $("#total").text(total);
                        });
                    </script>
                    @endforeach
                    @endif
                </div>
            </div>
            <input type="hidden" name="id" value="{{ $id }}">
            <div class="row" style="margin-top:10px">
                <div class="col-md-12" style="display: flex;">
                    <button type="submit" class="btn btn-primary" style="margin:auto">Assign courses</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    
</div>
</form>

@endsection
@section('scripts')
@endsection

