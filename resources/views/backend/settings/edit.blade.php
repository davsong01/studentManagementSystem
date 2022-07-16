@extends('layouts.app')
  <?php 
    $col1 = [
        'official_email',
        'official_phone',
        'current_session',
    ];

    $col2 = [
        'smtp_email',
        'smtp_host',
        'smtp_port',
        'smtp_username',
        'smtp_password',
        'mail_from_address',
        'mail_from_name',
    ];

    $col3 = [
        'PAYSTACK_PUBLIC_KEY',
        'PAYSTACK_SECRET_KEY',
        'PAYSTACK_PAYMENT_URL',
        'MERCHANT_EMAIL',
    ]
    
 ?>
@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Edit settings</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="/home" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>
        <hr>
    </div>
</div>
 <form action="{{ route('setting.update', $setting->id) }}" method="POST">
    @csrf
    @method('PATCH')
  
    <div class="row">
        <div class="col-md-12">
            <h5 style="color:blue; text-decoration:underline"><strong>Official Settings</strong></h5> <br>
        </div>

        @foreach($col1 as $col)
        <div class="col-md-4">
            <div class="form-group">
                <label for="{{ $col }}">{{ ucwords(str_replace('_', ' ', $col)) }}</label>
                <input type="text" class="form-control" id="name" value="{{ old($col) ?? $setting->$col }}" name="{{ $col }}" placeholder="Enter {{ ucwords(str_replace('_', ' ', $col)) }}">
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
         <div class="col-md-12">
            <h5 style="color:blue; text-decoration:underline"><strong>SMTP Settings</strong></h5> <br>
        </div>
        @foreach($col2 as $co)
        <div class="col-md-4">
            <div class="form-group">
                 <label for="{{ $co }}">{{ ucwords(str_replace('_', ' ', $co)) }}</label>
                <input type="text" class="form-control" id="name" value="{{ old($co) ?? $setting->$co }}" name="{{ $co }}" placeholder="Enter {{ ucwords(str_replace('_', ' ', $co)) }}">
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            <h5 style="color:blue; text-decoration:underline"><strong>Payment Gateway Settings</strong></h5> <br>
        </div>
        @foreach($col3 as $c)
        <div class="col-md-4">
            <div class="form-group">
                <label for="{{ $c }}">{{ ucwords(str_replace('_', ' ', $c)) }}</label>
                <input type="text" class="form-control" id="name" value="{{ old($c) ?? $setting->$c }}" name="{{ $c }}" placeholder="Enter {{ ucwords(str_replace('_', ' ', $c)) }}">
            </div>
        </div>
        @endforeach
    </div>
    <div class="col-12">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
</form>
@endsection