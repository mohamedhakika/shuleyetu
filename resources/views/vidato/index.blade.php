@extends('layouts.dashboard')

@section('page-heading')
    Classes and forms
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-5 col-md-12">
      <div class="card" style="min-height: 485px">
        <div class="header card-header-text">
          <h4 class="title">Classes and Forms list</h4>
          <p class="category">Year, {{ $year }}</p>
        </div>
        <div class="content table-responsive">
          @if(!$classes->isEmpty())
          <table class="table table-hover">
            <thead class="text-primary">
              <tr>
                <th>Form</th>
                <th>Stream</th>
                <th>Year</th>
                <th>Option</th>
              </tr>
            </thead>
            <tbody>
            @foreach($classes as $darasa)
              <tr>
                <td>{{$darasa->name}}</td>
                <td>{{$darasa->stream}}</td>
                <td>{{$darasa->year}}</td>
                <td>
									<form role="form" method="POST" action="{{ route('classes.destroy',$darasa->id) }}">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<button type="button" value="submit" rel="tooltip" title="Delete" class="btn btn-danger btn-simple btn-xs delete-class">
                    <i class="ti-close"></i>
                  </button>
									</form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          @else
            <p class="alert alert-warning text-center">
            You didn't set and form and class this year
            </p>
          @endif
        </div>
      </div>
    </div>
		<div class="col-lg-7 col-md-12">
			<div class="card" style="min-height: 400px">
				<div class="header">
					<h4 class="title">Set new class with streams</h4>
				</div>
				<div class="content">
					{!! Form::open(['url' => 'setting/classes', 'method' => 'POST']) !!}

						<div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
							<label class="control-label">Year *</label>

							{!! Form::text('year',$year,['class'=>'form-control','placeholder'=>'Year']) !!}

							@if ($errors->has('year'))
								<span class="help-block">
									<strong>{{ $errors->first('year') }}</strong>
								</span>
							@endif
					</div>

					<div class="form-group{{ $errors->has('name_form') ? ' has-error' : '' }}">
						<label class="control-label">Form/Class *</label>
						<select name="name_form" id="name_form" class="form-control selectpicker" style="width: 100%;">
							<option value="" selected disabled> Select Form </option>
							@foreach($vidato as $kidato)
								<option value="{{$kidato->id}}-{{$kidato->name}}" {{ old("name_form") == $kidato->name ? "selected":"" }}>
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
						<label class="control-label">Stream *</label>
						{!! Form::select('stream[]', ['A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'D', 'E'=>'E', 'F'=>'F'], null , ['class'=>'selectpicker form-control','multiple'=>'multiple', 'title'=>'Select Streams','data-style'=>'select-with-transition']); !!}

							@if ($errors->has('stream'))
								<span class="help-block">
									<strong>{{ $errors->first('stream') }}</strong>
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
