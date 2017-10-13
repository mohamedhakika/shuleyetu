@extends('layouts.dashboard')

@section('page-heading')
   Teacher's details
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="card" style="min-height: 400px">
				<div class="header">
					<h4 class="title" style="text-transform:capitalize;"><i class="ti-user"></i>  <span class="hidden-xs"><b>{{ $teacher->user->name }}</b> Details</span>
					
          <div class="btn-group pull-right">
						<a href="{{route('teachers.edit',$teacher->id)}}" class="btn btn-white"><i class="ti-pencil-alt"></i> <span class="hidden-xs">Edit Details</span> </a>
						<a href="{{route('user.reset.password',$teacher->user->id)}}" class="btn btn-primary"><i class="ti-lock"></i> <span class="hidden-xs">Reset Password</span> </a>
						<a href="{{route('teachers.index')}}" class="btn btn-info"><i class="fa fa-mail-reply"></i> <span class="hidden-xs">Back</span> </a>
					</div>
					</h4>
				</div>
				<div class="content">
					<div class="row">
						<div class="col-sm-7">
							<div class="card" style="min-height: 200px">
								<div class="content table-responsive">
									<table class="table">
										<tbody>
											<tr>
												<td><strong>First Name</strong></td>
												<td style="text-transform:capitalize;">{{ $teacher->first_name }}</td>
											</tr>
											<tr>
												<td><strong>Middle Name</strong></td>
												<td style="text-transform:capitalize;">{{ $teacher->middle_name }}</td>
											</tr>
											<tr>
												<td><strong>Last Name</strong></td>
												<td style="text-transform:capitalize;">{{ $teacher->last_name }}</td>
											</tr>
											<tr>
												<td><strong>Gender</strong></td>
												<td>{{ $teacher->user->gender }}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

						</div>
						<div class="col-sm-5">
							<div class="card" style="min-height: 200px">
								<div class="content table-responsive">
									<table class="table">
										<tbody>
											<tr>
												<td><strong>Email</strong></td>
												<td>{{ $teacher->user->email }}</td>
											</tr>
											<tr>
												<td><strong>Mobile</strong></td>
												<td>{{ $teacher->mobile_no }}</td>
											</tr>
											<tr>
												<td><strong>Home address</strong></td>
												<td>{{ $teacher->address }}</td>
											</tr>
										</tbody>
									</table>
									<blockquote class="blockquote" style="border-left: 5px solid #4CAF50; border-radius: 3px;">
										<footer>Added <cite rel="tooltip" title="{{ $teacher->created_at->toDayDateTimeString()}}">{{ $teacher->created_at->diffForHumans() }} by <b> {{ $teacher->addedBy->name }}</b> </cite> </footer>
									</blockquote>
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
