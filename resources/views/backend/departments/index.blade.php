

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Departments</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('department.create') }}" class="btn btn-primary">
                    <span class="ml-2 text-xs font-semibold"> <i class="fa fa-plus"></i> Add new</span>
                </a>
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
                <th>Name</th>
                <th>Faculty</th>
                <th>No of students</th>
                {{-- <th>No of students</th> --}}
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $dept)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $dept->name ?? '--' }}</td>
                <td>{{ $dept->faculty->name ?? '--' }}</td>
                <td>{{ $dept->students_count }}</td>
                <td>
                    <a href="{{ route('department.edit',$dept->id) }}">
                       <button type="button" class="btn btn-primary btn-sm"> <i class="fa fa-pencil"></i> Edit</button>
                    </a>
                    
                    <form action="{{ route('department.destroy',$dept->id) }}" method="POST" class="inline-flex ml-1">
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
