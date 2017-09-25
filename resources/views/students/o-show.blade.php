@extends('layouts.app')

@section('content')
   <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Students
        <small>
          O-level Students info.
        </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('olevel.index') }}"><i class="fa fa-list"></i> Students</a></li>
        <li class="active">
          Details
        </li>
      </ol>
    </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">
              <i class="fa fa-user"></i> {{ $student->user->name }} Details
            </h3>
            <div class="btn-group pull-right">
              <a href="{{route('olevel.edit',$student->id)}}" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i> Edit Details </a>
              <a href="{{route('password.reset',$student->id)}}" class="btn btn-primary"><i class="fa fa-lock"></i> Reset Password </a>
              <a href="{{route('olevel.index')}}" class="btn btn-info"><i class="fa fa-mail-reply"></i> Back </a>
            </div>
          </div>

          <div class="box-body">
            @if ($message = Session::get('success'))
              <div class="alert alert-success potea">
                <p>{{ $message }}</p>
              </div>
            @endif
            <div class="row">
              <div class="col-md-8">
                <blockquote class="blockquote" style="border-left: 5px solid #4CAF50; border-radius: 3px;">
                  <table class='table table-bordered table-condensed'>
                    <tr>
                      <th class='active'>
                        Full Name
                      </th>
                      <td>
                        {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
                      </td>
                    </tr>
                    <tr>
                      <th class='active'>
                        First Name
                      </th>
                      <td>
                        {{ $student->first_name }}
                      </td>
                    </tr>
                    <tr>
                      <th class='active'>
                        Middle Name
                      </th>
                      <td>
                        {{ $student->middle_name }}
                      </td>
                    </tr>
                    <tr>
                      <th class='active'>
                        Last Name
                      </th>
                      <td>
                        {{ $student->last_name }}
                      </td>
                    </tr>
                    <tr>
                      <th class='active'>
                        Gender
                      </th>
                      <td>
                        {{ $student->user->gender }}
                      </td>
                    </tr>
                    <tr>			       			
                      <th class='active'>
                        Email
                      </th>
                      <td>
                        {{ $student->user->email }}
                      </td>
                    </tr>
                  </table>
                </blockquote>

                <blockquote class="blockquote" style="border-left: 5px solid #4CAF50; border-radius: 3px;">
                  @php 
                    $this_year = date('Y'); 
                  @endphp
                  <table class='table table-bordered table-condensed'>
                    <tr>
                      <th class='active'>
                        Reg No
                      </th>
                      <td>
                        {{ $student->reg_no }}
                      </td>
                    </tr>
                    <tr>
                      <th class='active'>
                        Current Form
                      </th>
                      <td>
                        @foreach($student->forms as $form)
                          @if($this_year == $form->pivot->year)
                            {{ $form->name }} - {{ $form->stream }}
                          @endif
                        @endforeach
                      </td>
                    </tr>
                    <tr>			       			
                      <th class='active'>
                        Year admitted
                      </th>
                      <td>
                        {{ $student->year_admitted }}
                      </td>
                    </tr>
                    <tr>			       			
                      <th class='active'>
                        Home mobile no
                      </th>
                      <td>
                        {{ $student->mobile_no }}
                      </td>
                    </tr>
                    <tr>			       			
                      <th class='active'>
                        Home address
                      </th>
                      <td>
                        {{ $student->address }}
                      </td>
                    </tr>
                  </table>
                  <footer>Added <cite title="{{ $student->created_at}}">{{ $student->formatted_created_at }} by <b> {{ $student->addedBy->name }}</b> </cite> </footer>
                </blockquote>
              </div>
              <div class="col-md-4">
                <div class="box box-info">
                  <div class="box-header with-border">
                    <h3 class="box-title">Forms and years</h3>

                    <div class="box-tools">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus text-primary"></i>
                      </button>
                    </div>
                  </div>
                  <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                      @foreach($student->forms as $form)
                        <li class="{{ $form->pivot->year == $this_year ? 'active' : '' }}">
                          <a href="#"><i class="fa fa-tasks"></i> {{ $form->name }} - {{$form->stream}} <span class="label label-primary pull-right">{{ $form->pivot->year }}</span></a>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
