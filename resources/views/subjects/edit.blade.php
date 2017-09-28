@extends('layouts.dashboard')

@section('page-heading')
    Edit subject
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
		<div class="col-lg-8 col-lg-offset-2 col-md-12">
			<div class="card" style="min-height: 400px">
				<div class="header">
					<h4 class="title">Edit Subject</h4>
				</div>
				<div class="content">
					{!! Form::open(['route' => ['subjects.update', $subject->id], 'method' => 'POST']) !!}
          {{ method_field('PATCH') }}
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label class="control-label">Name *</label>

							{!! Form::text('name',$subject->name, ['class'=>'form-control','placeholder'=>'Enter subject name eg: History']) !!}

							@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
							@endif
					</div>
					<div class="category form-category">
						<span class="text-danger">*</span> Required fields
          </div>
					<div class="text-left">
            <br>
						<button type="submit" class="btn btn-primary btn-fill btn-wd">Update</button>
					</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
