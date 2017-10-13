@extends('layouts.dashboard')

@section('page-heading')
    Editing student details
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="card" style="min-height: 400px">
				<div class="header">
					<h4 class="title"><span class="hidden-xs">Editing O-level student</span>
            <div class="btn-group pull-right">
            <a href="{{route('olevel.show',$student->id)}}" class="btn btn-white"><i class="ti-eye"></i> <span class="hidden-xs">Show Details </span></a>
            <a href="{{route('password.reset',$student->id)}}" class="btn btn-primary"><i class="fa fa-lock"></i> <span class="hidden-xs">Reset Password </span></a>
            <a href="{{route('students.o-level')}}" class="btn btn-info"><i class="fa fa-mail-reply"></i> <span class="hidden-xs">Back </span></a>
          </div>
					</h4>
          <span class="visible-xs"><br></span>
				</div>
				<div class="content">
        <br>
          {!! Form::open(['url' => 'students/o-level/'.$student->id.'/'.$student->user->id, 'method' => 'POST']) !!}
            {{ method_field('PATCH') }}
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                <label for="first_name">First Name:<span style="color:red;"> *</span></label>
                <input id="first_name" type="text" class="form-control" name="first_name" placeholder="Enter first name" value="{{ $student->first_name }}" autofocus>
                @if ($errors->has('first_name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('first_name') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('middle_name') ? ' has-error' : '' }}">
                <label for="middle_name">Middle Name: </label>
                <input id="middle_name" type="text" class="form-control" name="middle_name" placeholder="Enter middle name" value="{{ $student->middle_name }}">
                @if ($errors->has('middle_name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('middle_name') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                <label for="last_name">Last name:<span style="color:red;"> *</span></label>
                <input id="last_name" type="text" class="form-control" name="last_name" placeholder="Enter last name" value="{{ $student->last_name }}">
                @if ($errors->has('last_name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('last_name') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                <label for="gender">Gender:<span style="color:red;"> *</span> </label>
                <div class="radio">
                  <input type="radio" data-toggle="radio" name="gender" value="Male" {{ $student->user->gender == "Male" ? "checked":"" }}>Male
                </div>
                <div class="radio">
                  <input type="radio" data-toggle="radio" name="gender" value="Female" {{ $student->user->gender == "Female" ? "checked":"" }}>Female
                </div>
                @if ($errors->has('gender'))
                  <span class="help-block">
                      <strong>{{ $errors->first('gender') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('reg_no') ? ' has-error' : '' }}">
                <label for="reg_no">Registration No:<span style="color:red;"> *</span></label>
                <input id="reg_no" type="text" class="form-control" name="reg_no" placeholder="Enter registration number" value="{{ $student->reg_no }}">
                @if ($errors->has('reg_no'))
                  <span class="help-block">
                    <strong>{{ $errors->first('reg_no') }}</strong>
                  </span>
                @endif
              </div>
              <p class="lead text-info"> <b>Student Login details</b></p>
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">Email:<span style="color:red;"> *</span></label>
                <input id="email" type="text" class="form-control" name="email" placeholder="Enter email" value="{{ $student->user->email }}">
                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <!-- start of right side of the form -->
            <div class="col-sm-6">
              <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                <label for="level">Level:<span style="color:red;"> *</span></label>
                <input type="text" class="form-control" name="level" value="{{ $level }}" disabled>
                @if ($errors->has('level'))
                  <span class="help-block">
                    <strong>{{ $errors->first('level') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('form_id') ? ' has-error' : '' }}">
                <label for="form_id">Form:<span style="color:red;"> *</span></label>
                <select name="form_id" id="form_id" class="form-control select2" style="width: 100%;">
                  <option value="" selected disabled> Select Form </option>
                  @foreach($classes as $kidato)
                    <option value="{{$kidato->id}}" {{ $currentFormId == $kidato->id ? "selected":"" }}>
                      {{ $kidato->name }} - {{ $kidato->stream }}
                    </option>
                  @endforeach
                </select>
                @if ($errors->has('form_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('form_id') }}</strong>
                  </span>
                @endif
                <br>
              </div>
              <div class="form-group{{ $errors->has('year_admitted') ? ' has-error' : '' }}">
                <label for="year_admitted">Year admitted:<span style="color:red;"> *</span></label>
                <input id="year_admitted" type="text" class="form-control" name="year_admitted" placeholder="Enter year admitted" value="{{ $student->year_admitted }}">
                @if ($errors->has('year_admitted'))
                  <span class="help-block">
                    <strong>{{ $errors->first('year_admitted') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                <label for="dob">Date of birth:<span style="color:red;"> *</span></label>
                <input id="dob" type="text" class="form-control datepicker" name="dob" placeholder="Date of birth" value="{{ $student->dob }}">
                @if ($errors->has('dob'))
                  <span class="help-block">
                    <strong>{{ $errors->first('dob') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                <label for="mobile">Home mobile NO:<span style="color:red;"> *</span></label>
                <input id="mobile" type="text" class="form-control" name="mobile" placeholder="Enter home mobile number" value="{{ $student->mobile_no }}">
                @if ($errors->has('mobile'))
                  <span class="help-block">
                    <strong>{{ $errors->first('mobile') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                <label for="address">Home address:<span style="color:red;"> *</span></label>
                <textarea class="form-control" name="address" placeholder="Enter home address">{{ $student->address }}</textarea>
                @if ($errors->has('address'))
                  <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
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
