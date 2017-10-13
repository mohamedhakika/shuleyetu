@extends('layouts.dashboard')

@section('page-heading')
    Editing teacher details
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="card" style="min-height: 400px">
				<div class="header">
					<h4 class="title"><i class="ti-user"></i> <span class="hidden-xs">Editing teacher</span>
            <div class="btn-group pull-right">
            <a href="{{route('teachers.show',$teacher->id)}}" class="btn btn-white"><i class="ti-eye"></i> <span class="hidden-xs"> Show Details</span> </a>
            <a href="{{route('user.reset.password',$teacher->user->id)}}" class="btn btn-primary"><i class="fa fa-lock"></i> <span class="hidden-xs">Reset Password </span></a>
            <a href="{{route('teachers.index')}}" class="btn btn-info"><i class="fa fa-mail-reply"></i> <span class="hidden-xs">Back </span></a>
          </div>
					</h4>
				</div>
				<div class="content">
        <br>
          {!! Form::open(['url' => 'staff/teachers/'.$teacher->id.'/'.$teacher->user->id, 'method' => 'POST']) !!}
            {{ method_field('PATCH') }}
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                  <label for="first_name">First Name:<span style="color:red;"> *</span></label>
                  <input style="text-transform:capitalize;" type="text" class="form-control" name="first_name" placeholder="Enter first name" value="{{ $teacher->first_name }}">
                  @if ($errors->has('first_name'))
                    <span class="help-block">
                      <strong class="text-danger">{{ $errors->first('first_name') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('middle_name') ? ' has-error' : '' }}">
                  <label for="middle_name">Middle Name: </label>
                  <input style="text-transform:capitalize;" type="text" class="form-control" name="middle_name" placeholder="Enter middle name" value="{{ $teacher->middle_name }}">
                  @if ($errors->has('middle_name'))
                    <span class="help-block">
                      <strong class="text-danger">{{ $errors->first('middle_name') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                  <label for="last_name">Last name/ Sir name:<span style="color:red;"> *</span></label>
                  <input style="text-transform:capitalize;" type="text" class="form-control" name="last_name" placeholder="Enter last name" value="{{ $teacher->last_name }}">
                  @if ($errors->has('last_name'))
                    <span class="help-block">
                      <strong class="text-danger">{{ $errors->first('last_name') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email">Email:<span style="color:red;"> *</span></label>
                  <input id="email" type="text" class="form-control" name="email" placeholder="Enter email" value="{{ $teacher->user->email }}">
                  @if ($errors->has('email'))
                    <span class="help-block">
                      <strong class="text-danger">{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <!-- start of right side of the form -->
              <div class="col-sm-6">
                
              <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                  <label for="gender">Gender:<span style="color:red;"> *</span> </label>
                  <div class="radio">
                    <input type="radio" data-toggle="radio" name="gender" value="Male" {{ $teacher->user->gender == "Male" ? "checked":"" }}>Male
                  </div>
                  <div class="radio">
                    <input type="radio" data-toggle="radio" name="gender" value="Female" {{ $teacher->user->gender == "Female" ? "checked":"" }}>Female
                  </div>
                  @if ($errors->has('gender'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('gender') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                  <label for="mobile">Mobile number:<span style="color:red;"> *</span></label>
                  <input id="mobile" type="text" class="form-control" name="mobile" placeholder="Enter home mobile number" value="{{ $teacher->mobile_no }}">
                  @if ($errors->has('mobile'))
                    <span class="help-block">
                      <strong class="text-danger">{{ $errors->first('mobile') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                  <label for="address">Home address:<span style="color:red;"> *</span></label>
                  <textarea class="form-control" name="address" rows="5" placeholder="Enter home address">{{ $teacher->address }}</textarea>
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
                <button type="submit" class="btn btn-warning btn-lg btn-block">Update</button>
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
