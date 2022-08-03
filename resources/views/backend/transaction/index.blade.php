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
                <th>#</th>
                <th>Details</th>
                <th>Payment</th>
                <th>Academic session</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $i++ }}</td>
                <td>
                    <b>Matric:</b>{{ $transaction->user->matric ?? 'Not set' }} <br>
                    <b>Department:</b>{{ $transaction->department->name ?? 'Not set' }} <br>
                    <b>Faculty:</b>{{ $transaction->faculty->name ?? 'Not set' }}
                </td>
                <td>{{ $transaction->name }} <br><small> <b>Reference:</b> {{ $transaction->reference }}</small> </td>
                <td>{{ $transaction->session }}</td>
                <td>&#8358;{{ number_format($transaction->amount) }}</td>
                <td>{{ $transaction->created_at }}</td>
                <td>{{ $transaction->status }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('payments.show', $transaction->id) }}" target="_blank" data-toggle="tooltip">
                        <i class="fa fa-eye"> Print</i>
                    </a>
                </td>
            </tr>
            @endforeach
    </table>
    </div>
</div>
@endsection
