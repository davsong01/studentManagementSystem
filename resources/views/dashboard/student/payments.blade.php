@extends('dashboard.student.index')
@section('page')
 <div class="col-md-9">
    <div class="row">
        <div class="col-md-12">
            <h3>Welcome {{ $student->user->name }}</h3>
            <hr>
        </div>
    </div>
    <div class="row">
        @foreach($payments as $payment)
        <div class="col-md-6" style="margin: 10px 0;">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('payments.initilize', $payment->id) }}" target="_blank" class="text-green">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 text-center v-align py-4">
                                <img src="/images/money_2.svg"
                                    alt="user_icon" width="50px" height="50px">
                            </div>
                            <div class="col-md-10 col-sm-8">
                                <div class="card-block px-3 py-3" style="height: 150px;">
                                    <p class="card-text">
                                        <b>{{ $payment->name }}</b><br>
                                        Make payment for {{ strtolower($payment->name) }}. <br>
                                        <span style="color:red">Amount: &#8358;{{ number_format($payment->amount, 2) }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row" style="margin-top:20px">
        <div class="col-md-12">
            <h3>Payment history</h3>
            <hr>
            <div class="col-md-6" style="margin: 10px 0;">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('payments.history') }}" target="_blank" class="text-green">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 text-center v-align py-4">
                                <img src="/images/money_2.svg"
                                    alt="user_icon" width="50px" height="50px">
                            </div>
                            <div class="col-md-10 col-sm-8">
                                <div class="card-block px-3 py-3" style="height: 150px;">
                                    <p class="card-text">
                                        <b>Payment history</b> <br>
                                        <span style="color:red">Print your payment history here.</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection