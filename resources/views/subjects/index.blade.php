@extends('layouts.dashboard')

@section('page-heading')
    Subjects
@endsection
@section('content')
<div class="container-fluid">
<div class="row">
  <div class="col-lg-2 col-md-6 col-sm-6">
    <div class="card">
			<div class="content">
				<div class="row">
					<div class="numbers">
						<p>Form I Subjects</p>
						{{$subjects_1->count()}}
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-2 col-md-6 col-sm-6">
    <div class="card">
			<div class="content">
				<div class="row">
					<div class="numbers">
						<p>Form II Subjects</p>
						{{$subjects_2->count()}}
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-2 col-md-6 col-sm-6">
    <div class="card">
			<div class="content">
				<div class="row">
					<div class="numbers">
						<p>Form III Subjects</p>
						{{$subjects_3->count()}}
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-2 col-md-6 col-sm-6">
    <div class="card">
			<div class="content">
				<div class="row">
					<div class="numbers">
						<p>Form IV Subjects</p>
						{{$subjects_4->count()}}
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-6">
    <div class="card">
			<div class="content">
				<div class="row">
					<a href="{{ route('subjects.create') }}" class="btn btn-primary btn-block btn-fill">
						<i class="fa fa-plus-circle"></i> Add new subject
					</a>
          <br>
        </div>
			</div>
		</div>
	</div>
</div>
<!--- here the end of tabs -->
  <div class="row">
		@if($subjects_1->isNotEmpty())
    <div class="col-lg-6 col-md-12">
      <div class="card" style="min-height: 350px">
        <div class="header card-header-text">
          <h4 class="title">Form I subjects list</h4>
        </div>
        <div class="content table-responsive">
          <table class="table table-hover">
            <thead class="text-primary">
              <tr>
                <th class="text-right">No</th>
                <th>Name</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach($subjects_1 as $subject)
              <tr>
                <td class="text-right">{{$loop->iteration}}</td>
                <td>{{$subject->name}}</td>
                <td class="td-actions text-right">
									<form role="form" method="POST" action="{{ route('subjects.destroy',$subject->id) }}">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<a href="{{ route('subjects.edit',$subject->id) }}" rel="tooltip" title="Edit subject name" class="btn btn-success btn-simple btn-xs">
												<i class="ti-pencil-alt"></i>
											</a>
                      <button type="button" value="submit" rel="tooltip" title="Delete subject" class="btn btn-danger btn-simple btn-xs delete-class">
                        <i class="ti-close"></i>
                      </button>
									</form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
		@endif

		@if($subjects_2->isNotEmpty())
    <div class="col-lg-6 col-md-12">
      <div class="card" style="min-height: 350px">
        <div class="header card-header-text">
          <h4 class="title">Form II subjects list</h4>
        </div>
        <div class="content table-responsive">
          <table class="table table-hover">
            <thead class="text-primary">
              <tr>
                <th class="text-right">No</th>
                <th>Name</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach($subjects_2 as $subject)
              <tr>
                <td class="text-right">{{$loop->iteration}}</td>
                <td>{{$subject->name}}</td>
                <td class="td-actions text-right">
									<form role="form" method="POST" action="{{ route('subjects.destroy',$subject->id) }}">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<a href="{{ route('subjects.edit',$subject->id) }}" rel="tooltip" title="Edit subject name" class="btn btn-success btn-simple btn-xs">
												<i class="ti-pencil-alt"></i>
											</a>
											<button type="button" value="submit" rel="tooltip" title="Delete subject" class="btn btn-danger btn-simple btn-xs delete-class">
                    <i class="ti-close"></i>
                  </button>
									</form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
		@endif

		@if($subjects_3->isNotEmpty())
    <div class="col-lg-6 col-md-12">
      <div class="card" style="min-height: 350px">
        <div class="header card-header-text">
          <h4 class="title">Form III subjects list</h4>
        </div>
        <div class="content table-responsive">
          <table class="table table-hover">
            <thead class="text-primary">
              <tr>
                <th class="text-right">No</th>
                <th>Name</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach($subjects_3 as $subject)
              <tr>
                <td class="text-right">{{$loop->iteration}}</td>
                <td>{{$subject->name}}</td>
                <td class="td-actions text-right">
									<form role="form" method="POST" action="{{ route('subjects.destroy',$subject->id) }}">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<a href="{{ route('subjects.edit',$subject->id) }}" rel="tooltip" title="Edit subject name" class="btn btn-success btn-simple btn-xs">
												<i class="ti-pencil-alt"></i>
											</a>
											<button type="button" value="submit" rel="tooltip" title="Delete subject" class="btn btn-danger btn-simple btn-xs delete-class">
                    <i class="ti-close"></i>
                  </button>
									</form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
		@endif

		@if($subjects_4->isNotEmpty())
    <div class="col-lg-6 col-md-12">
      <div class="card" style="min-height: 350px">
        <div class="header card-header-text">
          <h4 class="title">Form IV subjects list</h4>
        </div>
        <div class="content table-responsive">
          <table class="table table-hover">
            <thead class="text-primary">
              <tr>
                <th class="text-right">No</th>
                <th>Name</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach($subjects_4 as $subject)
              <tr>
                <td class="text-right">{{$loop->iteration}}</td>
                <td>{{$subject->name}}</td>
                <td class="td-actions text-right">
									<form role="form" method="POST" action="{{ route('subjects.destroy',$subject->id) }}">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<a href="{{ route('subjects.edit',$subject->id) }}" rel="tooltip" title="Edit subject name" class="btn btn-success btn-simple btn-xs">
												<i class="ti-pencil-alt"></i>
											</a>
											<button type="button" value="submit" rel="tooltip" title="Delete subject" class="btn btn-danger btn-simple btn-xs delete-class">
                    <i class="ti-close"></i>
                  </button>
									</form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
		@endif
	</div>
</div>
@endsection
