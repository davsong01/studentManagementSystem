@extends('dashboard.student.index')
@section('page')
 <div class="col-md-9">
    <div class="row">
        <div class="col-md-12">
            <h3>Dashboard</h3>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <a href="?pg=biodata" class="text-green">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 text-center v-align py-4">
                                <img src="https://portal.yabatech.edu.ng/portalplus/assets/icons/user.svg"
                                    alt="user_icon" width="50px" height="50px">
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="card-block px-3 py-3">
                                    <p class="card-text">
                                        <b>Biodata</b><br>
                                        Here you can print your biodata details.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <a href="?pg=course-registration" class="text-green">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 text-center v-align py-4">
                                <img src="https://portal.yabatech.edu.ng/portalplus/assets/icons/money_2.svg"
                                    alt="user_icon" width="50px" height="50px">
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="card-block px-3 py-3">
                                    <p class="card-text">
                                        <b>Course registration</b><br>
                                        Register and print your courses here.
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
@endsection