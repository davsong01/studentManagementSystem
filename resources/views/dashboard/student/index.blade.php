@extends('layouts.app')
@section('css')
<style>
    .text-green {
        text-decoration: none !important;
    }

</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-4">
            <div class="card mb-4 shadow-sm">
                <img class="card-img-top"
                    src="https://portal.yabatech.edu.ng/portalplus/passport_db/HND (COMPUTER SCIENCE) FULL TIME20162017/FHD163210065.jpg"
                    alt="Card image cap" width="150px;" height="230px">
                <div class="card-body text-center">
                    <p class="card-text">
                        <a href="?pg=biodata"></a></p>
                    <h5><a href="?pg=biodata"><b><strong>NO2/20/069</strong></b></a></h5>
                    <p></p>
                </div>
            </div>
            <div>
                <h6 class="">
                    <b>
                        {{ auth()->user()->name }} {{ auth()->user()->surname }} <br>
                    </b>
                </h6>
                <small class="text-muted">BSC (COMPUTER SCIENCE) FULL TIME</small>
            </div>
            <hr>
            <div>
                <small>Academic session:</small><br>
                <b>2021/2022</b>
            </div>
            <br>
            <div>
                <small>Current semester:</small><br>
                <b>FIRST SEMESTER</b>
            </div>
            <br>
            <div>
                <small>Current level</small><br>
                <b>LEVEL 200</b>
            </div>
            <br>
            <div>
                <small>Student status:</small><br>
                <b>STALLITE</b>
            </div>
            <br>
            <div>
                <small>School fees status:</small><br>
                <b>NOT PAID</b>
            </div>
            <br>
            <div>
                <small>Course registration status:</small><br>
                <b>NOT REGISTERED</b>
            </div>
            <br>
            
            <br>
            <br>
        </div>
       @yield('page')
    </div>
</div>
@endsection
