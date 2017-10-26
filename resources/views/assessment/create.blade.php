@extends('layouts.dashboard')

@section('page-heading')
    Student's assessments
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
  <div class="col-lg-6 col-md-12">
      <div class="card" style="min-height: 400px">
        <div class="header card-header-text">
          <h4 class="title">List of students that allready assessed.</h4>
          <p class="category">{{$darasa->name}} {{$darasa->stream}}, {{session('year')}}, {{session('term')==='1' ? 'First' : 'Second'}} term</p>
        </div>
        <div class="content table-responsive">
          @if($allstudents->isNotEmpty())
          <table class="table table-hover">
            <thead class="text-primary">
              <tr>
                <th class="text-right">No</th>
                <th>STUDENT NAME</th>
                <th class="text-right">ACTION</th>
              </tr>
            </thead>
            <tbody>
            @foreach($allstudents as $student)
              <tr>
                <td class="text-right">{{ $loop->iteration }}</td>
                <td>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
                <td class="td-actions text-right">
                  <a href="{{ route('teacher.editassessment',[$student->id, $class_id]) }}" rel="tooltip" title="Select {{$student->user->name}}" class="btn btn-default btn-xs pull-right">
                    <i class="ti-arrow-right"></i>
                    View
                  </a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          @else
            @if($students->isNotEmpty())
              <p class="alert alert-warning text-center">
                  <b>No students that allready assessed.</b>
              </p>
            @else
              <p class="alert alert-warning text-center">
                <b>No student registered in your class.</b>
              </p>
            @endif
          @endif
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-md-12">
      <div class="card" style="min-height: 400px">
        <div class="header card-header-text">
          <h4 class="title">Pick student to assess</h4>
          <p class="category">{{$darasa->name}} {{$darasa->stream}}, {{session('year')}}, {{session('term')==='1' ? 'First' : 'Second'}} term</p>
        </div>
        <div class="content table-responsive">
          @if($students->isNotEmpty())
          <table class="table table-hover">
            <thead class="text-primary">
              <tr>
                <th class="text-right">No</th>
                <th>STUDENT NAME</th>
                <th class="text-right">ACTION</th>
              </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
              <tr>
                <td class="text-right">{{ $loop->iteration }}</td>
                <td>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
                <td class="td-actions text-right">
                  <a href="{{ route('teacher.addassessment',[$class_id, $student->id]) }}" rel="tooltip" title="Select {{$student->user->name}}" class="btn btn-default btn-xs pull-right">
                    <i class="ti-arrow-right"></i>
                    Assess
                  </a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          @else
            @if($allstudents->isNotEmpty())
            <p class="alert alert-warning text-center">
                <b>All students are allready assessed.</b>
            </p>
          @else
            <p class="alert alert-warning text-center">
              <b>No student registered in your class.</b>
            </p>
          @endif
          @endif
        </div>
      </div>
    </div>
	</div>
</div>
@endsection
