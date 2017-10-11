@extends('layouts.dashboard')

@section('page-heading')
    Teachers
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="card" style="min-height: 400px">
        <div class="header">
					<h4 class="title">Teachers List 
					<a href="{{ route('teachers.create') }}" class="btn btn-primary btn-fill pull-right">
						<i class="fa fa-plus-circle"></i> Add new teacher
					</a>
					</h4>
				</div>

          <div class="content">
            @if( $teachers->isEmpty())
              <br>
              <p class="lead alert alert-warning text-center">
                No teachers at the moment
              </p>
            @else
              <div class="content table-responsive">
                <table class="table table-hover">
                <thead class="text-primary">
                  <tr>
                    <th>No</th>
                    <th>NAME</th>
                    <th>GENDER</th>
                    <th>MOBILE NO</th>
                    <th class="text-right">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($teachers as $teacher)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-transform:capitalize;">{{ $teacher->user->name }}</td>
                    <td style="text-transform:capitalize;">{{ $teacher->user->gender }}</td>
                    <td>{{ $teacher->mobile_no }}</td>
                    <td class="text-right">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('teachers.destroy',$teacher->id) }}">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                        <a href="{{ route('teachers.subjects',$teacher->id) }}" class="btn btn-success btn-fill">
                          <i class="ti-eye"></i> View subjects
                        </a>
                        <a href="{{ route('teachers.show',$teacher->id) }}" rel="tooltip" title="View teacher info" class="btn btn-success btn-simple btn-icon">
                          <i class="ti-eye"></i>
                        </a>
                        <a href="{{ route('teachers.edit',$teacher->id) }}" rel="tooltip" title="Edit teacher info" class="btn btn-warning btn-simple btn-icon">
                          <i class="ti-pencil-alt"></i>
                        </a>
                        <button type="button" value="submit" rel="tooltip" title="Delete teacher" class="btn btn-danger btn-simple btn-icon delete-class">
                          <i class="ti-close"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
                  {!! $teachers->render() !!}
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
