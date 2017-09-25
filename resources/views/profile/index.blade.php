@extends('layouts.app')

@section('title')
  User Profile
@endsection
@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>User Profile</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> User</a></li>
        <li class="active">Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Info boxes -->
<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('img/avater.png') }}" alt="User profile picture">

              <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

              <p class="text-muted text-center">
                @foreach(Auth::user()->roles as $role)
                  {{ $role->display_name }}
                @endforeach
              </p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="{{ $errors->isEmpty() ? 'active' : '' }}"><a href="#timeline" data-toggle="tab">My details</a></li>
              <li class="{{ $errors->isEmpty() ? '' : 'active' }}"><a href="#settings" data-toggle="tab">Change password</a></li>
            </ul>
            <div class="tab-content">
              <div class="{{ $errors->isEmpty() ? 'active' : '' }} tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          My Details
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">

                      <h3 class="timeline-header no-border"><a href="#">{{ Auth::user()->name }}</a>
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-red"></i>

                    <div class="timeline-item">

                      <h3 class="timeline-header"><a href="#">{{ Auth::user()->email }}</a> </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">

                      <h3 class="timeline-header"><a href="#">Joined</a></h3>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs"><strong>{{ Auth::user()->created_at }}</strong></a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="{{ $errors->isEmpty() ? '' : 'active' }} tab-pane" id="settings">
              <div class="row">
              <div class="col-sm-offset-2 col-sm-10">
                {!! Form::open(['url' => '/profile']) !!}
                  <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                      <label for="old_password" class="control-label">Current password:</label>
                      <input type="password" class="form-control" placeholder="Current Password" name="old_password">
                      @if ($errors->has('old_password'))
                        <span class="help-block">
                              <strong>
                                {{ $errors->first('old_password') }}
                              </strong>
                        </span>
                      @endif
                  </div>
                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">New Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter new password.">
                    @if ($errors->has('password'))
                        <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password_confirmation">Confirm New Password:</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm new password.">
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                          <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-danger">Submit</button>
                  </div>
                {!! Form::close() !!}
                </div>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  </section>
@endsection
