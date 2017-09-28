@extends('layouts.dashboard')

@section('page-heading')
    Assessments
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6 col-md-12">
      <div class="card" style="min-height: 485px">
        <div class="header card-header-text">
          <h4 class="title">Assessments list</h4>
        </div>
        <div class="content table-responsive">
          @if($tabias->isNotEmpty())
          <table class="table table-hover">
            <thead class="text-primary">
              <tr>
                <th>CodeID</th>
                <th>Assessment name</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach($tabias as $tabia)
              <tr>
                <td class="text-right">{{$tabia->codeID}}:</td>
                <td>{{$tabia->name}}</td>
                <td class="td-actions text-right">
									<form role="form" method="POST" action="{{ route('assessment.destroy',$tabia->id) }}">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<a href="{{ route('assessment.edit',$tabia->id) }}" rel="tooltip" title="Edit" class="btn btn-success btn-simple btn-xs">
												<i class="ti-pencil-alt"></i>
											</a>
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
            	No assessment set at the moment, use form to set.
            </p>
          @endif
        </div>
      </div>
    </div>
		<div class="col-lg-6 col-md-12">
			<div class="card" style="min-height: 400px">
				<div class="header">
					<h4 class="title">Set new assessment</h4>
				</div>
				<div class="content">
					{!! Form::open(['url' => 'setting/assessment', 'method' => 'POST']) !!}

						<div class="form-group{{ $errors->has('codeID') ? ' has-error' : '' }}">
							<label class="control-label">CodeID *</label>

							{!! Form::text('codeID',null, ['class'=>'form-control','placeholder'=>'Enter codeID eg: 901']) !!}

							@if ($errors->has('codeID'))
								<span class="help-block">
									<strong>{{ $errors->first('codeID') }}</strong>
								</span>
							@endif
					</div>

					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label class="control-label">Name *</label>
						{!! Form::textarea('name',null, ['class'=>'form-control','rows'=> '5']) !!}						
							@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
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
