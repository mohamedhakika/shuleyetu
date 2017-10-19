@extends('layouts.dashboard')

@section('page-heading')
    Dashboard
@endsection
@section('content')
<div class="container-fluid">
    @role('admin')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-warning text-center">
                                <i class="ti-stats-up"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Total students</p>
                                70,340
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="ti-alert text-warning"></i> 20% lower than last year
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-danger text-center">
                                <i class="ti-receipt"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Teachers</p>
                                102
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="ti-tag text-warning"></i> Product-wise sales
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-success text-center">
                                <i class="ti-money"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Revenue</p>
                                $23,100
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="ti-calendar"></i> Weekly sales
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-info text-center">
                                <i class="ti-twitter"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Followers</p>
                                +245
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="ti-reload"></i> Just Updated
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
    
    @role('teacher')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-warning text-center">
                                <i class="ti-stats-up"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Total students</p>
                                {{ Auth::user()->name }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="ti-alert text-warning"></i> 20% lower than last year
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-warning text-center">
                                <i class="ti-stats-up"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Total students</p>
                                70,340
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="ti-alert text-warning"></i> 20% lower than last year
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-warning text-center">
                                <i class="ti-stats-up"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Total students</p>
                                70,340
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="ti-alert text-warning"></i> 20% lower than last year
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-warning text-center">
                                <i class="ti-stats-up"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Total students</p>
                                70,340
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="ti-alert text-warning"></i> 20% lower than last year
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
</div>
@endsection
