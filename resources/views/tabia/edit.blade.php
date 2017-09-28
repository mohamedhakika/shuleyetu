@extends('layouts.dashboard')

@section('page-heading')
    Assessments Edit
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
		<div class="col-lg-8 col-lg-offset-2 col-md-12">
			<div class="card" style="min-height: 400px">
				<div class="header">
					<h4 class="title">Edit assessment</h4>
				</div>
				<div class="content">
					{!! Form::open(['route' => ['assessment.update', $tabia->id], 'method' => 'POST']) !!}
            {{ method_field('PATCH') }}
						<div class="form-group{{ $errors->has('codeID') ? ' has-error' : '' }}">
							<label class="control-label">CodeID *</label>

							{!! Form::text('codeID',$tabia->codeID, ['class'=>'form-control','placeholder'=>'Enter codeID eg: 901']) !!}

							@if ($errors->has('codeID'))
								<span class="help-block">
									<strong>{{ $errors->first('codeID') }}</strong>
								</span>
							@endif
					</div>

					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label class="control-label">Name *</label>
						{!! Form::textarea('name',$tabia->name, ['class'=>'form-control','rows'=> '5']) !!}						
							@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
							@endif
					</div>
					<div class="category form-category">
						<span class="text-danger">*</span> Required fields</div>
					<div class="text-center">
						<button type="submit" class="btn btn-primary btn-fill btn-wd">Update</button>
					</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
