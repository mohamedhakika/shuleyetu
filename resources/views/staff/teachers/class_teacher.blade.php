@extends('layouts.dashboard')

@section('page-heading')
    Teacher classes
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6 col-md-12">
      <div class="card" style="min-height: 300px">
        <div class="header card-header-text">
          <h4 class="title">Classes list for <b> <span style="text-transform:capitalize;">{{ $teacher->user->name }}</span></b></h4>
            @php
              $year = date('Y');
            @endphp
          <p class="category">Year, {{ $year }}</p>
        </div>
        <div class="content table-responsive">
          @if(!$teacher->classes->isEmpty())
          <table class="table table-hover">
            <thead class="text-primary">
              <tr>
                <th>FORM</th>
                <th>YEAR</th>
                <th class="text-right">OPTIONS</th>
              </tr>
            </thead>
            <tbody>
            @foreach($teacher->classes as $darasa)
              <tr>
                <td>{{$darasa->name}} {{$darasa->stream}}</td>
                <td>{{$darasa->year}}</td>
                <td class="text-right">
									<form role="form" method="POST" action="{{ route('classteacher.destroy',$darasa->pivot->id) }}">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<button type="button" value="submit" rel="tooltip" title="Unassign class" class="btn btn-danger btn-simple btn-xs delete-class">
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
                This teacher isn't assigned any class.
            </p>
          @endif
        </div>
      </div>
    </div>
		<div class="col-lg-6 col-md-12">
			<div class="card" style="min-height: 300px">
				<div class="header">
					<h4 class="title">Assign <span style="text-transform:capitalize;"><b>{{ $teacher->user->name }}</b></span> class</h4>
				</div>
				<div class="content">
					{!! Form::open(['route' => ['classteacher.store', $teacher->id], 'method' => 'POST']) !!}

					<div class="form-group{{ $errors->has('class_id') ? ' has-error' : '' }}">
						<label class="control-label">Form/Class *</label>
						<select name="class_id" id="class_id" class="form-control selectpicker" required>
							<option value="" selected disabled> Select a class </option>
							@foreach($classes as $darasa)
								<option value="{{$darasa->id}}" {{ old("class_id") == $darasa->id ? "selected":"" }}>
									{{ $darasa->name }} {{ $darasa->stream }}
								</option>
							@endforeach
						</select>
					
							@if ($errors->has('class_id'))
								<span class="help-block">
									<strong class="text-danger">{{ $errors->first('class_id') }}</strong>
								</span>
							@endif
					</div>
					<div class="category form-category">
						<span class="text-danger">*</span> Required fields
          </div>
					<div class="form-group">
            <br>
						<button type="submit" class="btn btn-rose btn-fill btn-wd">Assign class</button>
					</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
