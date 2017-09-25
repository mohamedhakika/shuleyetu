@extends('layouts.app')

@section('title')
  O-Students create
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
        Edit
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
              <i class="fa fa-user"></i> Editing {{ $student->user->name }} Details
            </h3>
            <div class="btn-group pull-right">
              <a href="{{route('olevel.show',$student->id)}}" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> Show Details </a>
              <a href="{{route('password.reset',$student->id)}}" class="btn btn-primary"><i class="fa fa-lock"></i> Reset Password </a>
              <a href="{{route('olevel.index')}}" class="btn btn-info"><i class="fa fa-mail-reply"></i> Back </a>
            </div>
          </div>

          <div class="box-body">
              @if ($message = Session::get('success'))
                <div class="alert alert-success potea">
                  <p>{{ $message }}</p>
                </div>
              @endif
            {!! Form::open(['url' => 'students/o-level/'.$student->id.'/'.$student->user->id, 'method' => 'POST']) !!}
              {{ method_field('PATCH') }}
            <div class="row">
              <div class="col-md-6">
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
                    <label class="input-group"><input type="radio" name="gender" value="Male" {{ $student->user->gender == "Male" ? "checked":"" }}>Male</label>
                  </div>
                  <div class="radio">
                    <label class="input-group"><input type="radio" name="gender" value="Female" {{ $student->user->gender == "Female" ? "checked":"" }}>Female</label>
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
              <div class="col-md-6">
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
            <div class="col-md-6">
              <div class="form-group">
                <button type="submit" class="btn btn-warning btn-lg btn-block">Update</button>
              </div>
            </div>
            <div class="col-md-6">
              &nbsp;
            </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
