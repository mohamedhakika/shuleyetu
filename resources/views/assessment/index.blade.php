@extends('layouts.dashboard')

@section('page-heading')
    Student's assessments
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6 col-lg-offset-3 col-md-12">
      <div class="card" style="min-height: 400px">
        <div class="header card-header-text">
          <h4 class="title">Chose a class to assess</h4>
        </div>
        <div class="content">
          @if($teacher->classes->isNotEmpty())
            <ul class="list-group">
              @foreach($teacher->classes as $darasa)
                <li class="list-group-item"><i class="ti-widget"></i>
                    {{ $darasa->name }} {{ $darasa->stream }}
                    <a href="{{route('teacher.createassessment', $darasa->id)}}" class="btn btn-default btn-xs pull-right"><i class="ti-arrow-right"></i> GO</a>
                </li>
              @endforeach
            </ul>
          @else
            <p class="alert alert-warning text-center">
            	You are not a class teacher of any class.
            </p>
          @endif
        </div>
      </div>
    </div>
	</div>
</div>
@endsection
