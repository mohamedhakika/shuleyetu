@extends('layouts.app')

@section('title')
  Student password reset
@endsection

@section('content')
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Students
      <small>
        O-level Students Edit.
      </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('olevel.index') }}"><i class="fa fa-list"></i> Students</a></li>
      <li class="active">
        Reset Password
      </li>
    </ol>
  </section>
<!-- Main Contents -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">
              <i class="fa fa-user"></i> Reset {{ $student->user->name }} Password
            </h3>
            <div class="btn-group pull-right">
              <a href="{{route('olevel.index')}}" class="btn btn-info"><i class="fa fa-mail-reply"></i> Back </a>
            </div>
          </div>

          <div class="box-body">
              @if ($message = Session::get('success'))
                <div class="alert alert-success potea">
                  <p>{{ $message }}</p>
                </div>
              @endif
            {!! Form::open(['url' => 'students/reset/'.$student->id.'/'.$student->user->id, 'method' => 'POST']) !!}
            {{ method_field('PATCH') }}
            <div class="row">
              <div class="col-md-12">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">Name:<span style="color:red;"> *</span></label>
                  <input id="name" type="text" class="form-control" name="name" value="{{ $student->user->name }}" disabled>
                  @if ($errors->has('name'))
                    <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email">Email:<span style="color:red;"> *</span></label>
                  <input id="email" type="text" class="form-control" name="email" placeholder="Enter email" value="{{ $student->user->email }}" disabled>
                  @if ($errors->has('email'))
                    <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password">New Password:<span style="color:red;"> *</span></label>
                  <input id="password" type="password" class="form-control" name="password" placeholder="Enter password" value="{{ old('password') }}" autofocus>
                  @if ($errors->has('password'))
                    <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                  <label for="password_confirmation">Confirm New Password</label>
                  <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" value="{{ old('password_confirmation') }}">
                  @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-danger">Reset Password</button>
                </div>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
