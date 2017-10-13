@extends('layouts.dashboard')

@section('page-heading')
    Creating new teacher
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="card" style="min-height: 400px">
				<div class="header">
					<h4 class="title">New Teacher 
					<a href="{{ route('teachers.index') }}" class="btn btn-primary btn-fill pull-right">
						<i class="fa fa-list"></i> <span class="hidden-xs"> Teachers list</span>
					</a>
					</h4>
				</div>
				<div class="content">
					{!! Form::open(['url' => 'staff/teachers', 'method' => 'POST']) !!}
          <div class="row">
              <div class="col-sm-6">
                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                  <label for="first_name">First Name:<span style="color:red;"> *</span></label>
                  <input style="text-transform:capitalize;" type="text" class="form-control" name="first_name" placeholder="Enter first name" value="{{ old('first_name') }}" autofocus>
                  @if ($errors->has('first_name'))
                    <span class="help-block">
                      <strong class="text-danger">{{ $errors->first('first_name') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('middle_name') ? ' has-error' : '' }}">
                  <label for="middle_name">Middle Name: </label>
                  <input style="text-transform:capitalize;" type="text" class="form-control" name="middle_name" placeholder="Enter middle name" value="{{ old('middle_name') }}">
                  @if ($errors->has('middle_name'))
                    <span class="help-block">
                      <strong class="text-danger">{{ $errors->first('middle_name') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                  <label for="last_name">Last name/ Sir name:<span style="color:red;"> *</span></label>
                  <input style="text-transform:capitalize;" type="text" class="form-control" name="last_name" placeholder="Enter last name" value="{{ old('last_name') }}">
                  <input type="hidden" name="role_id" value="{{ $role_id }}">
                  @if ($errors->has('last_name'))
                    <span class="help-block">
                      <strong class="text-danger">{{ $errors->first('last_name') }}</strong>
                    </span>
                  @endif
                </div>
                <p class="lead text-info"> <b>Teacher Login details</b></p>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email">Email:<span style="color:red;"> *</span></label>
                  <input id="email" type="text" class="form-control" name="email" placeholder="Enter email" value="{{ old('email') }}">
                  @if ($errors->has('email'))
                    <span class="help-block">
                      <strong class="text-danger">{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password">Password:<span style="color:red;"> *</span></label>
                  <input id="password" type="password" class="form-control" name="password" placeholder="Enter password" value="{{ old('password') }}">
                  @if ($errors->has('password'))
                    <span class="help-block">
                      <strong class="text-danger">{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                  <label for="password_confirmation">Confirm Password</label>
                  <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" value="{{ old('password_confirmation') }}">
                  @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                      <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <!-- start of right side of the form -->
              <div class="col-sm-6">
                
              <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                  <label for="gender">Gender:<span style="color:red;"> *</span> </label>
                  <div class="radio">
                    <input type="radio" data-toggle="radio" name="gender" value="Male" {{ old("gender") == "Male" ? "checked":"" }}>Male
                  </div>
                  <div class="radio">
                    <input type="radio" data-toggle="radio" name="gender" value="Female" {{ old("gender") == "Female" ? "checked":"" }}>Female
                  </div>
                  @if ($errors->has('gender'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('gender') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                  <label for="mobile">Mobile number:<span style="color:red;"> *</span></label>
                  <input id="mobile" type="text" class="form-control" name="mobile" placeholder="Enter home mobile number" value="{{ old('mobile') }}">
                  @if ($errors->has('mobile'))
                    <span class="help-block">
                      <strong class="text-danger">{{ $errors->first('mobile') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                  <label for="address">Home address:<span style="color:red;"> *</span></label>
                  <textarea class="form-control" name="address" rows="5" placeholder="Enter home address">{{ old('address') }}</textarea>
                  @if ($errors->has('address'))
                    <span class="help-block">
                      <strong class="text-danger">{{ $errors->first('address') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Register</button>
              </div>
            </div>
            <div class="col-sm-6">
              &nbsp;
            </div>
            </div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
