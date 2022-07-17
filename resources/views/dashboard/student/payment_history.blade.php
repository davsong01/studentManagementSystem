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
            <h3>Print Payment receipt</h3>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            
            <table class="table table-responsive" style="width: 100%; border: 0px;">
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>Payment</th>
                        <th>Academic session</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php $i=1 ?>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $i++ }}</td>
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
                </tbody>
            </table>
        </div>
    </div>
</div>
</form>
@endsection
