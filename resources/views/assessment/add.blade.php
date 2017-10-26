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
          <h4 class="title text-center">Assessment for <b>{{ $student->user->name }}</b> {{session('term')==='1' ? 'first' : 'second'}} term {{session('year')}}</h4>
        </div>
        <div class="content table-responsive">
          @if($tabia->isNotEmpty())
          @php
            $year = date('Y');
          @endphp
          {!! Form::open(['route' => ['teacher.storeassessment', $class_id, $student->id], 'method' => 'POST']) !!}
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
            @foreach($tabia as $tabi)
              <tr>
                <td class="text-right">{{ $loop->iteration }}</td>
                <td>{{ $tabi->codeID }}: {{ $tabi->name }}</td>
                <td class="td-actions text-left">
                 <div class="form-group">
                  <input type="hidden" name="tabia_id[]" value="{{$tabi->id}}">
                  <input type="text" name="grade[]" class="form-control col-lg-2" placeholder="Eg. B" required value="{{old('grade[]')}}">
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
            <button type="submit" class="btn btn-rose btn-fill btn-wd">Submit</button>
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
