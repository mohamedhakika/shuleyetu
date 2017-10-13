@extends('layouts.dashboard')

@section('page-heading')
    O-Level student's details
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="card" style="min-height: 400px">
				<div class="header">
					<h4 class="title"><span class="hidden-xs"><i class="ti-user"></i>  <b>{{ $student->user->name }}</b> Details</span>
					
          <div class="btn-group pull-right">
            <a href="{{route('olevel.edit',$student->id)}}" class="btn btn-white"><i class="ti-pencil-alt"></i> <span class="hidden-xs">Edit Details </span></a>
            <a href="{{route('password.reset',$student->id)}}" class="btn btn-primary"><i class="ti-lock"></i> <span class="hidden-xs">Reset Password </span></a>
            <a href="{{route('students.o-level')}}" class="btn btn-info"><i class="fa fa-mail-reply"></i> <span class="hidden-xs">Back </span></a>
          </div>
					</h4>
					<span class="visible-xs"><br></span>
				</div>
				<div class="content">
					<div class="row">
						<div class="col-sm-8">
							<div class="card" style="min-height: 200px">
								<div class="content table-responsive">
									<table class="table">
										<tbody>
											<tr>
												<td><strong>First Name</strong></td>
												<td>{{ $student->first_name }}</td>
											</tr>
											<tr>
												<td><strong>Middle Name</strong></td>
												<td>{{ $student->middle_name }}</td>
											</tr>
											<tr>
												<td><strong>Last Name</strong></td>
												<td>{{ $student->last_name }}</td>
											</tr>
											<tr>
												<td><strong>Gender</strong></td>
												<td>{{ $student->user->gender }}</td>
											</tr>
											<tr>
												<td><strong>Email</strong></td>
												<td>{{ $student->user->email }}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

							<div class="card" style="min-height: 200px">
									@php 
                    $this_year = date('Y'); 
                  @endphp
								<div class="content table-responsive">
									<table class="table">
										<tbody>
											<tr>
												<td><strong>Reg No</strong></td>
												<td>{{ $student->reg_no }}</td>
											</tr>
											<tr>
												<td><strong>Current Form</strong></td>
												<td>
													@foreach($student->forms as $form)
														@if($this_year == $form->pivot->year)
															{{ $form->name }} - {{ $form->stream }}
														@endif
													@endforeach
												</td>
											</tr>
											<tr>
												<td><strong>Year admitted</strong></td>
												<td>{{ $student->year_admitted }}</td>
											</tr>
											<tr>
												<td><strong>Home mobile no</strong></td>
												<td>{{ $student->mobile_no }}</td>
											</tr>
											<tr>
												<td><strong>Home address</strong></td>
												<td>{{ $student->address }}</td>
											</tr>
										</tbody>
									</table>
									<blockquote class="blockquote" style="border-left: 5px solid #4CAF50; border-radius: 3px;">
										<footer>Added <cite title="{{ $student->created_at}}">{{ $student->formatted_created_at }} by <b> {{ $student->addedBy->name }}</b> </cite> </footer>
									</blockquote>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="card card-user" style="min-height: 100px">
								<div class="content">
									<legend></legend>
									{!! Form::open(['route' => ['students.profile', $student->id],'files'=>'true']) !!}
										{{ method_field('PATCH') }}
									<div class="fileinput fileinput-new text-center" data-provides="fileinput">
										<div class="fileinput-new thumbnail img-circle">
											@if(is_null($student->thumbnail))
												<img src="{{ asset('img/avatar.png') }}" alt="Profile Image">
											@else
												<img src="{{ asset($student->thumbnail) }}" alt="Profile Image">
											@endif
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
										<div>
												<span class="btn btn-warning btn-file">
														<span class="fileinput-new">Change photo</span>
														<span class="fileinput-exists">Change</span>
														<input type="file" name="profileimg" required/>
												</span>
												<br />
												<a href="#profile" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
										</div>
										@if ($errors->has('profileimg'))
											<span class="help-block">
												<strong class="text-danger">{{ $errors->first('profileimg') }}</strong>
											</span>
										@endif
										<h4 class="title">{{ $student->user->name }}</h4>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-default btn-fill">Submit Photo</button>
								</div>
								{!! Form::close() !!}
								</div>
							</div>
							<div class="card" style="min-height: 100px">
								<div class="header">
									<h4 class="title"><i class="ti-angle-double-right text-info"></i>  Forms and year</h4>
								</div>
								<div class="content table-responsive">
									<table class="table">
										<thead>
										</thead>
										<tbody>
											@foreach($student->forms as $form)
											<tr class="{{ $form->pivot->year == $this_year ? 'active' : '' }}">
												<td><strong><i class="ti-notepad text-info"></i> {{ $form->name }} - {{$form->stream}}</strong></td>
												<td><span class="label label-default pull-right">{{ $form->pivot->year }}</span></td>
											</tr>
                      @endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
