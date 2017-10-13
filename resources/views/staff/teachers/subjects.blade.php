@extends('layouts.dashboard')

@section('page-heading')
   Teacher's subjects
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="card" style="min-height: 400px">
				<div class="header">
					<h4 class="title" style="text-transform:capitalize;"><span class="hidden-xs"><i class="ti-user"></i>  Subjects taught by <b>{{ $teacher->user->name }}</b></span>
					
          <div class="btn-group pull-right">
						<a href="{{route('teachers.addsubjects',$teacher->id)}}" class="btn btn-white" title="Add subject"><i class="fa fa-plus-circle"></i> Add subject </a>
						<a href="{{route('teachers.index')}}" class="btn btn-info"><i class="fa fa-mail-reply"></i> <span class="hidden-xs"> Back</span> </a>
					</div>
          <span class="visible-xs"><br></span>
					</h4>
				</div>
				<div class="content">
        <br>
        @if(!$subjects->isEmpty())
        <div class="content table-responsive">
          <table class="table table-hover">
            <thead class="text-primary">
              <tr>
                <th>SUBJECT</th>
                <th>FORM</th>
                <th>YEAR</th>
                <th class="text-right">OPTION</th>
              </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)
              <tr>
                <td>{{$subject->subject_name}}</td>
                <td>{{$subject->class_name}} - {{$subject->stream}}</td>
                <td>{{$subject->year}}</td>
                <td class="text-right">
									<form role="form" method="POST" action="{{ route('teachersub.destroy',$subject->id) }}">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<button type="button" value="submit" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs delete-class">
                    <i class="ti-close"></i>
                  </button>
									</form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          </div>
          @else
            <br>
            <p class="alert alert-warning text-center">
            <b>{{ $teacher->user->name }}</b> not assigned any subject yet this year.
            </p>
          @endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
