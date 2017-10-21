<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'School') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/school.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-muli.css') }}" rel="stylesheet">
    <link href="{{ asset('css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
    <div class="wrapper">
		  <div class="sidebar" data-background-color="brown" data-active-color="danger">
        <div class="logo">
          <a href="#" class="simple-text">
            Students RMS
          </a>
        </div>
        <div class="logo logo-mini">
          <a href="#" class="simple-text">
            RMS
          </a>
        </div>
        <div class="sidebar-wrapper">
          <ul class="nav">
            <li class="{{ Request::path() == 'home' ? 'active' : '' }}">
              <a href="{{ url('/home') }}">
                <i class="fa fa-dashboard"></i>
                <p>Dashboard</p>
              </a>
            </li>
            @role('admin')
            <li class="{{ Request::is('students/*') ? 'active' : '' }}">
						<a data-toggle="collapse" href="#students" class="collapsed" aria-expanded="false">
							<i class="fa fa-graduation-cap"></i>
							<p>Students
								<b class="caret"></b>
							</p>
						</a>
						<div class="collapse" id="students" role="navigation" aria-expanded="false" style="height: 0px;">
							<ul class="nav">
								<li class="{{ Request::is('students/o-level') ? 'active' : '' }}">
									<a href="{{ route('students.o-level') }}"> O-Level</a>
								</li>
                <li class="{{ Request::is('students/a-level') ? 'active' : '' }}">
									<a href="{{ route('students.a-level') }}"> A-Level</a>
								</li>
							</ul>
						</div>
					</li>
          <li class="{{ Request::is('staff/*') ? 'active' : '' }}">
						<a data-toggle="collapse" href="#staff" class="collapsed" aria-expanded="false">
							<i class="ti-user"></i>
							<p>Staff
								<b class="caret"></b>
							</p>
						</a>
						<div class="collapse" id="staff" role="navigation" aria-expanded="false" style="height: 0px;">
							<ul class="nav">
								<li class="{{ Request::is('staff/teachers') ? 'active' : '' }}">
									<a href="{{ route('teachers.index') }}"> Teachers</a>
								</li>
                <li class="#">
									<a href="#"> Accountants</a>
								</li>
                <li class="#">
									<a href="#"> Administrators</a>
								</li>
							</ul>
						</div>
					</li>
          <li class="{{ Request::is('setting/*') ? 'active' : '' }}">
						<a data-toggle="collapse" href="#settings" class="collapsed" aria-expanded="false">
							<i class="ti-settings"></i>
							<p>Settings
								<b class="caret"></b>
							</p>
						</a>
						<div class="collapse" id="settings" role="navigation" aria-expanded="false" style="height: 0px;">
							<ul class="nav">
								<li class="{{ Request::is('setting/classes') ? 'active' : '' }}">
									<a href="{{ route('setting.classes') }}"> Classes & Forms</a>
								</li>
                <li class="{{ Request::is('setting/assessment') ? 'active' : '' }}">
									<a href="{{ route('setting.assessment') }}"> Assessments</a>
								</li>
                <li class="{{ Request::is('setting/subjects') ? 'active' : '' }}">
									<a href="{{ route('setting.subjects') }}"> Subjects</a>
								</li>
							</ul>
						</div>
					</li>
          @endrole
          @role('teacher')
          <li class="{{ Request::is('assessment/teacher/*') ? 'active' : '' }}">
            <a href="{{ route('teacher.assessment', Auth::user()->teacher->id) }}">
              <i class="ti-thought"></i>
              <p>Assesment</p>
            </a>
          </li>
          @endrole
          </ul>
        </div>
      </div>
      <div class="main-panel">
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                <i class="ti-arrow-left"></i>
              </button>
            </div>
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <!-- Page tittle -->
              
              <a class="navbar-brand" href="#">
                  @yield('page-heading')
              </a>
            </div>
            <div class="collapse navbar-collapse">
              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                  <li><a href="{{ route('login') }}">Login</a></li>
                  <!-- <li><a href="{{ route('register') }}">Register</a></li> -->
                @else
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="collapse">
                      <i class="ti-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                    @role('student')
                      <li> 
                        <a href="{{ route('students.my_profile',Auth::user()->id) }}">
                          <i class="ti-user"></i>
                          My Profile
                        </a>
                      </li>
                    @else
                      <li> 
                        <a href="{{ route('profile.user') }}">
                          <i class="ti-user"></i>
                          My Profile
                        </a>
                      </li>
                    @endrole
                      <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                          <i class="ti-new-window"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                        </form>
                      </li>
                    </ul>
                  </li>
                @endguest
              </ul>
            </div>
          </div>
        </nav>
       
        <div class="content">
          @yield('content')
          <flash message="{{ session('flash') }}"></flash>
        </div>
        <footer class="footer">
          <div class="container-fluid">
          <p class="copyright pull-right">
            Copyright &copy;
            @php
              echo date('Y');
            @endphp
            <a href="#">Secondary School</a>
          </p>
          </div>
        </footer>
      </div>
    </div>
  </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('js/school.js') }}"></script>
    <script src="{{ asset('js/checkbox-radio.js') }}"></script>
    <script src="{{ asset('js/datepicker3.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('js/select-bootstrap.js') }}"></script>
    <script src="{{ asset('js/upload-bootstrap.min.js') }}"></script>

    <script>
      $(document).ready(function() {
        $('li.dropdown').click( function(e){
          $(this).toggleClass('open');
        });
        $('.datepicker').datepicker({
          autoclose: true,
          startView: 2,
          format: "yyyy-mm-dd"
        });

        $('.delete-class').on('click', function(e){
          e.preventDefault();
          var form = $(this).parents('form');
          swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-danger',
            cancelButtonClass: 'btn btn-default',
            confirmButtonText: 'Yes, delete it!',
            buttonsStyling: false
          }).then(function() {
            form.submit();
          },function(dismiss){
            
          });
        });
        $(".notify-me").on('click', function(){
          $.notify({
              icon: "notifications",
              message: "Welcome to <b>Material Dashboard</b> - a beautiful freebie for every web developer."

          },{
              type: "success",
              timer: 3000,
              placement: {
                  from: "top",
                  align: "center"
              }
          });
        });
      });
      window.setTimeout(function() {
        $(".potea").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
      }, 4000);
    </script>
    @yield('javascript')
</body>
</html>
