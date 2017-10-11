@extends('layouts.dashboard')

@section('page-heading')
   Add teacher's subjects
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
		<div class="col-lg-8 col-lg-offset-2 col-md-12">
			<div class="card" style="min-height: 300px">
				<div class="header">
					<h5 class="title" style="text-transform:capitalize;"><i class="ti-user"></i> Adding subjects taught by <b>{{ $teacher->user->name }}</b>
					
          <div class="btn-group pull-right">
						<a href="{{route('teachers.subjects',$teacher->id)}}" class="btn btn-white"><i class="ti-list"></i> View subjects </a>
					</div>
					</h5>
				</div>
				<div class="content">
        <br>
        <addsubject inline-template>
        {!! Form::open(['route' => ['addteachers.subjects', $teacher->id], 'method' => 'POST']) !!}
          <div class="form-group{{ $errors->has('name_form') ? ' has-error' : '' }}">
            <label class="control-label">Form/Class *</label>
            <select name="name_form" id="name_form" class="form-control selectpicker" v-on:change="getId">
              <option value="" selected disabled> Select Form </option>
              @foreach($vidato as $kidato)
                <option value="{{$kidato->id}}" {{ old("name_form") == $kidato->name ? "selected":"" }}>
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
          <div class="form-group{{ $errors->has('subject_id') ? ' has-error' : '' }}">
            <label class="control-label">Subject *</label>
              <select name="subject_id" id="subject_id" class="form-control selectpicker" title="Select Subject" data-style ="select-with-transition">
                <option v-for="subject in subjects" v-bind:value="subject.id">
                  @{{subject.name}}
                </option>
              </select>
              @if ($errors->has('subject_id'))
                <span class="help-block">
                  <strong>{{ $errors->first('subject_id') }}</strong>
                </span>
              @endif
          </div>
          <div class="form-group{{ $errors->has('class_id') ? ' has-error' : '' }}">
            <label class="control-label">Form/ Class *</label>
            <select name="class_id[]" id="class_id" class="form-control selectpicker" multiple title="Select Class" data-style ="select-with-transition">
              <option v-for="darasa in classes" v-bind:value="darasa.id">
                @{{darasa.name}} - @{{darasa.stream}}
              </option>
            </select>

            @if ($errors->has('class_id'))
              <span class="help-block">
                <strong>{{ $errors->first('class_id') }}</strong>
              </span>
            @endif
          </div>
          <div class="category form-category">
            <span class="text-danger">*</span> Required fields</div>
          <div class="text-center">
            <button type="submit" class="btn btn-rose btn-fill btn-wd">Add subjects</button>
          </div>
          {!! Form::close() !!}
          </addsubject>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
