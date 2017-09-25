@extends('layouts.app')

@section('title')
  Classes settings
@endsection
@section('content')
   <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Classes & Forms
        <small>
          list
        </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">
          @foreach(Auth::user()->roles as $name)
            {{ $name->display_name }}
          @endforeach
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Classes & Forms</h3>
                </div>

                <div class="box-body">
                  <div class="row">
                    <div class="col-md-8 col-sm-8">
                      @if ($message = Session::get('success'))
                        <p class="potea alert alert-success text-center">
                          {{ $message }}
                        </p>
                      @endif
                      @if(!$classes->isEmpty())
                        <table class="table table-striped table-hover table-bordered">
                          <thead>
                            <tr>
                              <th>Form:</th>
                              <th>Stream:</th>
                              <th>year:</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($classes as $darasa)
                            <tr>
                              <td>{{$darasa->name}}</td>
                              <td>{{$darasa->stream}}</td>
                              <td>{{$darasa->year}}</td>
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
                      @else
                        <p class="lead alert alert-warning text-center">
                        You didn't set and form and class this year
                        </p>
                      @endif
                    </div>
                    <div class="col-md-4 col-sm-4">
                    <p class="lead alert alert-success text-center"> Set new class with streams </p>
                      {!! Form::open(['url' => 'setting/classes', 'method' => 'POST']) !!}

                        <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                          <label for="name">Year:<span style="color:red;"> *</span></label>

                          {!! Form::text('year',$year,['class'=>'form-control','placeholder'=>'Year']) !!}

                          @if ($errors->has('year'))
                            <span class="help-block">
                              <strong>{{ $errors->first('year') }}</strong>
                            </span>
                          @endif
                      </div>

                      <div class="form-group{{ $errors->has('name_form') ? ' has-error' : '' }}">
                        <label for="name_form">Form/Class:<span style="color:red;"> *</span></label>
                        <select name="name_form" id="name_form" class="form-control select2" style="width: 100%;">
                          <option value="" selected disabled> Select Form </option>
                          @foreach($vidato as $kidato)
                              <option value="{{$kidato->name}}" {{ old("name_form") == $kidato->name ? "selected":"" }}>
                                {{ $kidato->name }}
                              </option>
                          @endforeach
                        </select>
                      
                          @if ($errors->has('name_form'))
                              <span class="help-block">
                                      <strong>{{ $errors->first('name_form') }}</strong>
                              </span>
                          @endif
                      </div>
                      <div class="form-group{{ $errors->has('stream') ? ' has-error' : '' }}">
                        <label for="stream">Stream:<span style="color:red;"> * </span></label>
                        {!! Form::select('stream[]', ['A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'D', 'E'=>'E', 'F'=>'F'], null , ['class'=>'form-control select2','multiple'=>'multiple', 'data-placeholder'=>'Select Streams', 'style'=>'width: 100%;']); !!}

                          @if ($errors->has('stream'))
                              <span class="help-block">
                                      <strong>{{ $errors->first('stream') }}</strong>
                              </span>
                          @endif
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>

                      {!! Form::close() !!}

                      <vidato></vidato>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
