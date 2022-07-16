@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Upload results</h2>
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
                <th>Matric Number</th>
                <th>Program</th>
                <th>Faculty</th>
                <th>Level</th>
                <th>Department</th>
                <th>Semester</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $result->user->matric }}</td>
                <td>{{ $result->program }}</td>
                <td>{{ $result->faculty->name }}</td>
                <td>{{ $result->level.'00' }}</td>
                <td>{{ $result->department->name }}</td>
                <td>{{ $result->semester }} semester</td>
                <td style="color:{{ $result->status == 'draft' ? 'red' : 'green'}}">{{ ucfirst($result->status) }}</td>
                
                {{-- <td><strong>{{ $result->program }}, </strong>{{ $result->session }}, {{ $result->level }}00 level, <br>{{ $result->semester }} Semester</td>
                <td><small>{{ $result->faculty->name }}, <br> Department of {{ $result->department->name }}</small></td>
                <td>{{ $result->semester }} Semester</td>
                --}}
                <td>
                    <a href="{{ route('courseForm.edit',$result->id) }}">
                       <button type="button" class="btn btn-primary btn-sm"> <i class="fa fa-pencil"></i> Edit</button>
                    </a>
                    <form onsubmit="confirm('This course form and all its courses will no longer be available to students')" action="{{ route('courseForm.destroy',$result->id) }}" method="POST" class="inline-flex ml-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete </button>
                    </form>
                </td>
            </tr>
            @endforeach
    </table>
    </div>
</div>
@endsection
