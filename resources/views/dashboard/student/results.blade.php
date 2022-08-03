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
            <h3>Print Result</h3>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div>
                <h5 style="display:inline-block">Please select result to print</h5> <br>
                <hr>
            </div>
            <table class="table table-responsive" style="width: 100%; border: 0px;">
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>Academic Session</th>
                        <th>Semester</th>
                        <th>Program</th>
                        <th>Level</th>
                        <th>GPA</th>
                        <th>CGPA</th>
                        <th>Option</th>
                    </tr>
                    <?php $i=1 ?>
                    @foreach($results as $result)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $result->academic_session }}</td>
                        <td>{{ strtoupper($result->semester) }} SEMESTER</td>
                        <td>{{ $result->program }}</td>
                        <td>{{ $result->level }}00</td>
                        <td>{{ $result->gpa }}</td>
                        <td>{{ $result->cgpa }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('result.show', $result->id) }}" target="_blank" data-toggle="tooltip">
                                <i class="fa fa-eye"> View</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</form>
@endsection
