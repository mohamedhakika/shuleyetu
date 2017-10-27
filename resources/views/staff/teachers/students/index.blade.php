@extends('layouts.dashboard')

@section('page-heading')
    Teacher's subjects
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-md-12">
      <div class="card" style="min-height: 400px">
        <div class="header card-header-text">
          <h4 class="title">Choose a subject</h4>
        </div>
        <div class="content table-responsive">
          @if($subjects->isNotEmpty())
          @php
            $year = date('Y');
          @endphp
            @foreach($subjects as $subject)
              {!! Form::open(['route' => ['teacher.setassessment', $subject->teacher_id], 'method' => 'POST']) !!}
                <table id="add-me" class="table table-hovered">
                  <tbody class="table-container">  
                    <tr>
                      <td class="col-md-3">
                        <i class="ti-widget"></i> {{ $subject->subject_name }}  
                      </td>
                      <td class="col-md-3">
                        {{ $subject->class_name }} {{ $subject->class_stream}} 
                      </td>
                      <td class="col-md-2">
                        {!! Form::text('year', $subject->year,['class'=>'form-control','placeholder'=>'Year', 'required', 'readonly']) !!}  
                      </td>
                      <td class="col-md-4">
                        {!! Form::select('term', ['1'=>'First term', '2'=>'Second term'], null , ['class'=>'selectpicker form-control', 'title'=>'Select term', 'required']); !!}  
                      </td>
                      <td class="col-md-1">
                        <button type="submit" class="btn btn-default btn-xs pull-right"><i class="ti-arrow-right"></i> GO</button>  
                      </td>
                    </tr>
                  </tbody>
                </table>
              {!! Form::close() !!}
            @endforeach
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