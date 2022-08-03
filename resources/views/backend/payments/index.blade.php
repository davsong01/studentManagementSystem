

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Payments</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('payments.create') }}" class="btn btn-primary">
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
                <th>Amount</th>
                <th>Session</th>
                <th>Class</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $payment->name }}</td>
                <td>&#8358;{{ number_format($payment->amount) }}</td>
                <td><strong>{{ $payment->program != '0' ? $payment->program : 'All Programs'}}, </strong>{{ $payment->level != '0' ? $payment->level.'00 level' : 'All levels' }}, <br>{{ $payment->semester != 0 ? $payment->semester .' Semester' : 'All semesters' }}</td>
                <td><small><strong>Faculty:</strong> {{ $payment->faculty->name ?? 'All Faculties' }} <br>
                    <strong>Department:</strong> {{ $payment->department->name ?? 'All Departments' }}
                </small></td>
                <td>{{ ucfirst($payment->status) }}</td>
                <td>
                    <a href="{{ route('payments.edit',$payment->id) }}">
                       <button type="button" class="btn btn-primary btn-sm"> <i class="fa fa-pencil"></i> Edit</button>
                    </a>
                    <form action="{{ route('payments.destroy',$payment->id) }}" method="POST" class="inline-flex ml-1">
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
