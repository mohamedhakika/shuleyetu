@extends('layouts.app')

@section('title')
  O-Students
@endsection

@section('content')
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Students
      <small>O-level students</small>
      <a href="{{ route('olevel.create') }}" class="btn btn-warning pull-right"><i class="fa fa-plus-circle"></i> <span> New O-level Student</span> </a>
    </h1>
  </section>
<!-- Main Contents -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">

          <div class="box-body">
            @if ($message = Session::get('success'))
              <div class="alert alert-success potea">
                <p>{{ $message }}</p>
              </div>
            @endif
            @if( $students->isEmpty())
              <p class="lead alert alert-warning text-center">
                No students at the moment
              </p>
            @else
              <div class="table-responsive">
                @php  
                  $this_year = date('Y'); 
                @endphp
                <table class="table table-striped">
                  <caption class="lead text-center"><b>O-LEVEL STUDENTS LIST</b></caption>
                  <tr>
                    <th>No</th>
                    <th>NAME</th>
                    <th>GENDER</th>
                    <th>REG No</th>
                    <th>CLASS</th>
                    <th>HOME MOBILE</th>
                    <th width="280px">ACTION</th>
                  </tr>
                  @foreach ($students as $student)
                  <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $student->user->name }}</td>
                    <td class="capitalize">{{ $student->user->gender }}</td>
                    <td>{{ $student->reg_no }}</td>
                    <td>
                    @foreach($student->forms as $form)
                      @if($this_year == $form->pivot->year)
                        {{ $form->name }} - {{ $form->stream }}
                      @endif
                    @endforeach
                    </td>
                    <td>{{ $student->mobile_no }}</td>
                    <td>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('olevel.destroy',$student->id) }}">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                        <div class="btn-group btn-group-xs" role="group" aria-label="Extra-small button group">
                          <a class="btn btn-primary" href="{{ route('olevel.show',$student->id) }}">View</a>
                          &nbsp;&nbsp;
                            <a class="btn btn-warning" href="{{ route('olevel.edit',$student->id) }}">Edit</a>
                          &nbsp;&nbsp;
                            <button value="submit" class="yenyewe btn btn-danger" title="Delete" data-toggle="modal" data-target="#confirmDelete" data-title="Delete Student ({{$student->user->name}}) ?" data-message="">Delete</button>
                          &nbsp;&nbsp;
                        </div>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </table>
                  {!! $students->render() !!}
              </div>
              <!-- Start of delete confirm -->
              <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h3 class="modal-title">Delete Parmanently</h3>
                    </div>
                    <div class="modal-body">
                      <p class="lead">This will delete all informations about the student,
                      <br>And you won't be able to undo this action,
                      <br>Are you sure you want to delete this ?
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-danger" id="btnYes">Yes Delete Student</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End of delete confirm -->
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('javascript')
  <script>
    $('#confirmDelete').on('show.bs.modal', function (e) {
      // $message = $(e.relatedTarget).attr('data-message');
      // $(this).find('.modal-body p').text($message);
      $title = $(e.relatedTarget).attr('data-title');
      $(this).find('.modal-title').text($title);
      var form = $(e.relatedTarget).closest('form');
      $(this).find('.modal-footer #btnYes').data('form', form);
    });

    $('.yenyewe').on('click', function(e) {
        e.preventDefault();
    });

    $('#btnYes').on('click', function(){
        $(this).data('form').submit();
    });
  </script>
@endsection
