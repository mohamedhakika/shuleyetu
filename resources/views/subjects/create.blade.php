@extends('layouts.dashboard')

@section('page-heading')
    Create new subject
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
		<div class="col-lg-8 col-lg-offset-2 col-md-12">
			<div class="card" style="min-height: 400px">
				<div class="header">
					<h4 class="title">New Subject 
					<a href="{{ route('setting.subjects') }}" class="btn btn-primary btn-fill pull-right">
						<i class="fa fa-list"></i> View subjects list
					</a>
					</h4>
				</div>
				<div class="content">
					{!! Form::open(['url' => 'setting/subjects', 'method' => 'POST']) !!}

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label class="control-label">Name *</label>

							{!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'Enter subject name eg: History']) !!}

							@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
							@endif
					</div>

					<div class="form-group{{ $errors->has('vidato_id') ? ' has-error' : '' }}">
            <label>Form <span style="color:red;"> *</span></label>
            <select name="vidato_id[]" class="form-control selectpicker" multiple="multiple" title="Select Form" data-style="select-with-transition">
              @foreach($vidato as $kidato)
								<option value="{{$kidato->id}}" {{ old("vidato_id") == $kidato->name ? "selected":"" }}>
									{{ $kidato->name }}
								</option>
              @endforeach
            </select>
          
              @if ($errors->has('vidato_id'))
								<span class="help-block">
												<strong>{{ $errors->first('vidato_id') }}</strong>
								</span>
              @endif
          </div>
					<div class="category form-category">
						<span class="text-danger">*</span> Required fields</div>
					<div class="text-center">
						<button type="submit" class="btn btn-rose btn-fill btn-wd">Register</button>
					</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
