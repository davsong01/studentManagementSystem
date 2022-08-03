@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Upload result</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('result.index') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
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
                <th>Rid</th>
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
                <td class="table-small">{{ $i++ }}</td>
                <td class="table-small">{{ $result->id }}</td>
                <td class="table-small">{{ $result->user->matric }}</td>
                <td class="table-small">{{ $result->program }}</td>
                <td class="table-small">{{ $result->faculty->name }}</td>
                <td class="table-small">{{ $result->level.'00' }}, <br>{{ $result->academic_session }} Session</td>
                <td class="table-small">{{ $result->department->name }}</td>
                <td class="table-small">{{ $result->semester }}</td>
                <td class="table-small"  style="color:{{ $result->status == 'draft' ? 'red' : 'green'}}">{{ ucfirst($result->status) }} <br>
                    @if($result->status == 'published') 
                    <a href="{{ route('admin-result.show',$result->id) }}">
                       <button type="button" class="btn btn-success btn-sm" style="margin-bottom:0px"> <i class="fa fa-eye"></i> View</button>
                    </a>
                    @endif
                </td>
                <td class="table-small">
                    <a href="{{ route('result.edit',[$result->id, 'param'=>base64_encode(json_encode($requests))])}}">
                       <button type="button" class="btn btn-primary btn-sm" style="margin-bottom:6px"> <i class="fa fa-pencil"></i> Edit</button>
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
