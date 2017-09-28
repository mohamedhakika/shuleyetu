@extends('layouts.dashboard')

@section('page-heading')
    User Profile
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
      <div class="card card-user">
        <div class="author">
          <a href="#avata">
            <img class="img avatar" src="{{ asset('img/avatar.png') }}" />
          </a>
        </div>
        <div class="content">
          @foreach(Auth::user()->roles as $role)
            <h6 class="category text-gray">
                {{ $role->display_name }}
            </h6>
          @endforeach
          <h4 class="title">{{ Auth::user()->name }}</h4>
          <p class="description">
            @foreach(Auth::user()->roles as $role)
              {{ $role->description }}
            @endforeach
          </p>
          <a href="#avata" class="btn btn-rose btn-round">Follow</a>
        </div>
      </div>
    </div>
    <!--mwisho-->
    <div class="col-md-8">
							<div class="card" id="profile-main">
								<div class="content">
									<div class="nav-tabs-navigation">
										<div class="nav-tabs-wrapper">
											<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
												<li class="{{ $errors->isEmpty() ? 'active' : '' }}"><a href="#profile11" aria-controls="profile11" role="tab" data-toggle="tab">My Profile Details</a>
												</li>
												<li class="{{ $errors->isEmpty() ? '' : 'active' }}"><a href="#pass-change" aria-controls="pass-change" role="tab" data-toggle="tab">Change Password</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane {{ $errors->isEmpty() ? 'active' : '' }}" id="profile11">
                      <h4>General</h4>
											<hr>
											<p class="lead"><strong>Name</strong>  {{ Auth::user()->name }} </p>
											<p class="lead"><strong>Email</strong>  {{ Auth::user()->email }} </p>
											<p class="lead"><strong>Gender</strong>  {{ Auth::user()->gender }} </p>
											<p class="lead"><strong>Joined</strong>  {{ Auth::user()->created_at->diffForHumans() }} </p>
										</div>
										<div role="tabpanel" class="tab-pane {{ $errors->isEmpty() ? '' : 'active' }}" id="pass-change">
                    {!! Form::open(['route' => ['profile.password', Auth::user()->id]]) !!}
                      {{ method_field('PATCH') }}
                  <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                      <label for="old_password" class="control-label">Current Password:</label>
                      <input type="password" class="form-control" placeholder="Current Password" name="old_password">
                      @if ($errors->has('old_password'))
                        <span class="help-block">
                              <strong class="text-danger">
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
                          <strong class="text-danger">{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password_confirmation">Confirm New Password:</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm new password.">
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                          <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <br>
                    <button type="submit" class="btn btn-danger">Change Password</button>
                  </div>
                {!! Form::close() !!}
										</div>
									</div>
								</div>
							</div>
                        </div>
  </div>
</div>
@endsection
