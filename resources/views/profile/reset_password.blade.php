@extends('layouts.dashboard')

@section('page-heading')
User password reset
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-md-12">
      <div class="card" style="min-height: 485px">
        <div class="header card-header-text">
          <h4 class="title" style="text-transform:capitalize;"><i class="ti-user"></i> Reset <strong>{{ $user->name }}</strong> Password
          <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-info pull-right"><i class="fa fa-mail-reply"></i> Back </a>
          </h4>
        </div>
        <div class="content">
          {!! Form::open(['url' => 'profile/user/'.$user->id, 'method' => 'POST']) !!}
            {{ method_field('PATCH') }}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name">Name:<span style="color:red;"> *</span></label>
              <input style="text-transform:capitalize;" type="text" class="form-control" name="name" value="{{ $user->name }}" disabled>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email">Email:<span style="color:red;"> *</span></label>
              <input id="email" type="text" class="form-control" name="email" placeholder="Enter email" value="{{ $user->email }}" disabled>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password">New Password:<span style="color:red;"> *</span></label>
              <input id="password" type="password" class="form-control" name="password" placeholder="Enter password" value="{{ old('password') }}" autofocus>
              @if ($errors->has('password'))
                <span class="help-block">
                  <strong class="text-danger">{{ $errors->first('password') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
              <label for="password_confirmation">Confirm New Password</label>
              <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" value="{{ old('password_confirmation') }}">
              @if ($errors->has('password_confirmation'))
                <span class="help-block">
                  <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-danger">Reset Password</button>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
	</div>
</div>
@endsection
