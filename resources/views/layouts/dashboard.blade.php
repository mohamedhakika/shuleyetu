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
            SIS
          </a>
        </div>
        <div class="sidebar-wrapper">
          <ul class="nav">
            <li class="active">
              <a href="../index.html">
                <i class="ti-panel"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li>
              <a href="../bosss.html">
                <i class="ti-panel"></i>
                <p>Magumashi mengine</p>
              </a>
            </li>
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
              <!-- Branding Image -->
              <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'School') }}
              </a>
            </div>
            <div class="collapse navbar-collapse">
              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                  <li><a href="{{ route('login') }}">Login</a></li>
                  <li><a href="{{ route('register') }}">Register</a></li>
                @else
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      <i class="ti-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
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
</body>
</html>
