

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Transaction history</h2>
            </div>
            
        </div>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table id="example" class="display" style="width:100%">
            <?php $i = 1; ?>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Transaction ID</th>
                <th>Reference</th>
                <th>Student details</th>
                <th>Payment details</th>
                <th>Other details</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $course->course_code }}</td>
                <td>{{ $course->course_title }}</td>
                <td>{{ $course->faculty->name }}</td>
                <td>{{ $course->department->name }}</td>
                <td>{{ $course->department->name }}</td>
                
            </tr>
            @endforeach
    </table>
    </div>
</div>
@endsection
