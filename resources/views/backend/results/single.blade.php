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
                <h2 class="text-gray-700 uppercase font-bold">Edit result for: {{ $result->user->matric }}</h2>
                <p style="color:blue">
                     NOTE: Please crosscheck these data thoroughly, someone's academic life depends on it <br>
                     Data here is gotten from the course forms which the student has submitted
                </p>
            </div>
            <?php 
                $param = base64_decode($pram);
                $param = json_decode($param, true);
                $param = http_build_query($param) ;
            ?>
            <div class="flex flex-wrap items-center">
                <a href="/result-faculty?{{ $param }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>
        <hr>
    </div>
</div>
<form onSubmit="return confirm('Clicking OK will make this result available to the student, make sure you have cross checked your input');" action="{{ route('result.update', $result->id) }}" method="POST">
    @csrf
    @method('patch')
    <input type="hidden" name="pram" value="{{ $pram }}">
<div class="row">
    <div class="col-md-12">
        <h5 style="display:inline-block;">Result details</h5> <br>
        <p>
        <label class="switch">
        <input id="result-toggle" type="checkbox" {{ $result->status == 'published' ? 'checked' : '' }}>
        <span class="slider round"></span>
        </label> <span style="color:#2196f3">Toggle result visibility on/off</span> <br>
        <span id="spinner"></span>
        </p>
        
        <hr>
    </div>
</div>
<?php 
    $courses = json_decode($result->courses, true);
?>
<div class="row">
    @if(isset($courses) && !empty($courses))
    @foreach($courses as $course)
    <div class="col-md-3">
        <div class="form-group">
            <label for="{{ $course['id'] }}">{{ ucwords($course['title']) }}</label>
            <input type="number" value="{{ old($course['id']) ?? $course['score']}}" min="1" max="100" required name="scores[{{ $course['id'] }}]" placeholder="Enter score" id="{{ $course['id'] }}" class="form-control">
        </div>
    </div>
    @endforeach
    @endif
    
</div>
<div class="row">
    <div class="col-12" style="margin-top:10px">
    <div class="form-group">
        <div class="col-md-12" style="display: flex;">
            <button type="submit" class="btn btn-primary" style="margin:auto">Submit</button>
        </div>
    </div>
</div>
</form>

@endsection
@section('scripts')
<script>
$("#result-toggle").change(function() {
    if(this.checked) {
        var status = 'published';
    }else{
        var status = null;
    }
    var id = "{{ $result->id }}";
    $.ajax({
        url: '/publish-result',
        type: "POST",
        data: {
            id : id,
            status : status,
        },
        beforeSend: function(xhr){
            $("#spinner").html('<i class="fa fa-spinner"></>');
        },
        success: function(res){
            $("#spinner").html('<small>Update successful</small>');
            toastr.info("Update successful");
        }
    });
});


</script>
@endsection