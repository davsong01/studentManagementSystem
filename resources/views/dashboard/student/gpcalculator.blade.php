@extends('dashboard.student.index')
@section('css')
<style>
    #available-courses {
        background: antiquewhite;
        padding: 10px;
    }

</style>
@endsection
@section('page')
<div class="col-md-9">
    <div class="row">
        <div class="col-md-12">
            <h3><strong>GP Calculator</strong></h3>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div>
                <h5 style="display:inline-block">Add courses as required</h5> <br>
                <hr>
            </div>
        </div>
    </div>
    <form action="{{ route('gp.cal2') }}" method="post">
        @csrf
    <div id="course-holder">
        <div class="row" id="course-0">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="code">Course code</label>
                    <input type="text" class="form-control" value="{{ old('code') }}" name="code[]" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="unit">Course unit</label>
                    <input type="number" class="form-control" id="unit" value="{{ old('unit')}}" name="unit[]" min="1" max="100" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="mark">Score</label>
                    <input type="number" class="form-control" id="mark" value="{{ old('mark') }}" name="mark[]" min="0" max="100" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="mark" style="color:white">sd</label>
                    <button class="btn btn-sm btn-primary float-right form-control" type="button" id="add-course"><i class="fa fa-plus"></i> Add course</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-info" type="submit">Calculate GP</button>
        </div>
    </div>
    </form>
    @if(\Session::has('courses'))
    <div class="row" style="margin-top:30px" id="results">
        <div class="col-md-12">
            <h1><strong>Results</strong></h1>
            <p style="color:red">NOTE: These details are not saved and will be discarded once you clear the results!</p>
            <table class="table" style="width: 100%; border: 0px;">
                <tbody>
                        <tr>
                            <th style="width:10%">#</th>
                            <th style="width:40%">Course code</th>
                            <th style="width:30%">Units</th>
                            <th style="width:10%">Score</th>
                        </tr>
                    
                    <?php $i=1 ?>
                    @foreach(\Session::get('courses') as $result)
                    <tr>
                        <td style="width:10%">{{ $i++ }}</td>
                        <td style="width:40%">{{ $result['title']}}</td>
                        <td style="width:30%">{{ \Session::get('gp')['units']}}</td>
                        <td style="width:10%">{{ $result['score'] }}</td>
                    </tr>
                    @endforeach
                    <tr style="background-color:#e62323; color:white">
                        <th></th>
                        <th>Weighted Average: {{ \Session::get('gp')['wp']}}</th>
                        <th>Grade Point: {{ \Session::get('gp')['gp']}}</th>
                        <th></th>
                    </tr>
                </tbody>
                    
            </table>
        </div>
        <div class="col-md-12">
            <button id="clear" class="btn btn-dark">Clear</button>
        </div>
    </div>
    @endif
</div>

@endsection
@section('scripts')
 <script>
    $("#add-course").on('click', function () {
        //get last ID
        var lastChild = $("#course-holder").children().last();
        var lastId = $(lastChild).attr('id').split('-');

        var id = lastId[1] + 1;

        var child = `<div class="row" id="course-`+id+`">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">Course code</label>
                        <input type="text" class="form-control" value="{{ old('code') }}" name="code[]" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="unit">Course unit</label>
                        <input type="number" class="form-control" id="unit" value="{{ old('unit')}}" name="unit[]" min="1" max="100" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="mark">Score</label>
                        <input type="number" class="form-control" id="mark" value="{{ old('mark') }}" name="mark[]" min="0" max="100" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="mark" style="color:white">sdsdsddsdssd</label>
                        <button class="btn btn-danger remove-course" id="remove-course-`+id+`" type="button" style="min-width: unset;"> <i class="fa fa-minus"></i> Remove</button>
                    </div>
                </div>
            </div>`
        $("#course-holder").append(child);      
        });

    $("#course-holder").on('click','.remove-course', function(e) {
        var removeId = $(e.target).attr('id').split('-');

        var id = removeId[2];
        $("#course-"+id).remove();
    });

      $("#clear").on('click', function () {
            $.ajax({
            url: '/clear-session',
            type: "get",
            success: function(res){
                 $('#results').hide();
            }
        });

      });
</script>
@endsection
