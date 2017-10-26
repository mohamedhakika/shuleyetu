@extends('layouts.dashboard')

@section('page-heading')
    Student's assessments
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-md-12">
      <div class="card" style="min-height: 400px">
        <div class="header card-header-text">
          <h5 class="title">View/Update assessments for <b>{{ $student->user->name }}</b>
          <a href="{{ route('teacher.createassessment', $class_id) }}" class="btn btn-primary btn-fill pull-right">
              <i class="ti-arrow-left"></i> <span class="hidden-xs">Cancel</span>
            </a>
          </h5>
          <p class="category">
            {{session('term')==='1' ? 'First' : 'Second'}} term, {{session('year')}}
          
          </p>
        </div>
        <div class="content table-responsive">
          @if($student->tabia->isNotEmpty())
          {!! Form::open(['route' => ['teacher.updateassessment', $student->id, $class_id], 'method' => 'PATCH']) !!}
          @if($errors->isNotEmpty())
          <p class="alert alert-danger text-center">
            	<b>Oops samething went wrong fill again carefully</b><br>
              1. use capital letters eg. A or B or F.<br>
              2. use only single letter.
          </p>
          @endif
          <table class="table table-hover">
            <thead class="text-primary">
              <tr>
                <th class="text-right">No</th>
                <th>ASSESSMENTS</th>
                <th class="text-right">GRADE</th>
              </tr>
            </thead>
            <tbody>
            @foreach($student->tabia as $tabi)
              <tr>
                <td class="text-right">{{ $loop->iteration }}</td>
                <td>{{ $tabi->codeID }}: {{ $tabi->name }}</td>
                <td class="td-actions text-left">
                 <div class="form-group">
                  <input type="hidden" name="is_id[]" value="{{$tabi->pivot->id}}">
                  <input type="hidden" name="tabia_id[]" value="{{$tabi->id}}">
                  <input type="text" name="grade[]" class="form-control col-lg-2" placeholder="Eg. B" required value="{{$tabi->pivot->grade}}">
                 </div>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          <div class="category form-category">
              All fields are required
          </div>
          <div class="text-left">
            <br>
            <button type="submit" class="btn btn-rose btn-fill btn-wd">Update</button>
          </div>
          {!! Form::close() !!}
          @else
          <p class="alert alert-warning text-center">
            	<b>No assessments, contact administrator.</b>
          </p>
          @endif
        </div>
      </div>
    </div>
	</div>
</div>
@endsection
