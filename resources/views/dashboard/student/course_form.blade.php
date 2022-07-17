@extends('dashboard.student.index')
@section('css')
    <style>
        #available-courses{
            background: antiquewhite;
            padding: 10px;
        }
        
    </style>
@endsection
@section('page')
<div class="col-md-9">
    <div class="row">
        <div class="col-md-12">
            <h3>{{ $title ?? 'Welcome ' .$student->user->name}} </h3>
            <hr>
        </div>
    </div>

    <form action="{{ route('coursesform.save', $student->id) }}" onSubmit="return confirm('You will not be able to edit this course form once you submit it');" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div>
                <h5 style="display:inline-block">Please select the courses you want to register for this semester</h5> <br>
                <strong style="color: red"><span></span> Maximum number of units: {{ $maximum_unit }}units</strong> <br>
                <label style="padding:10px 0; color:blue"> <strong>Total Units selected: <span id="total">0</span>units</strong> </label>
                <hr>
                <div id="available-courses">
                    <div class="row">
                        @if(isset($available) && count($available) > 0)
                        {{-- {{ $course->id }} --}}
                        @foreach($available as $course)
                        <div class="col-md-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="{{ $course->id }}" name="courses[]" value="{{ $course->id }}" {{ isset($selected) && in_array($course->id, $selected) ? 'checked' : ''}}>
                                <label class="form-check-label" for="{{ $course->id }}">{{ $course->title }} | 
                                    <span style="color:blue">{{ $course->code }}</spamn> | 
                                    <span style="color:red">{{ $course->units }}units</span> | 
                                    <span style="color:green"> {{ $course->type }}</span>
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
                <input type="hidden" name="id" value="{{ $c->id }}">
                <div class="row" style="margin-top:10px">
                    <div class="col-md-12" style="display: flex;">
                        <button type="submit" class="btn btn-primary" style="margin:auto">Submit course form</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</form>
@endsection