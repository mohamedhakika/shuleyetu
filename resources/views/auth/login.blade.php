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
  <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
  <div class="container">
      <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Secondary School</a>
          <a class="navbar-brand" href="{{ url('/') }}">Home</a>
      </div>
  </div>
</nav>
<div class="wrapper wrapper-full-page">
  <div class="full-page login-page"  data-color="purple">
      <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
      <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">

                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="card card-login card-hidden">
                            <div class="header text-center">
                                <h3 class="title"><i class="ti-lock"></i> Login</h3>
                            </div>
                            <div class="content">
                                <div class="social-line text-center">
                                    @if($message = Session::get('success'))
                                        <p class='text-warning potea'> {{ $message }} </p>
                                    @endif
                                    <h5>Welcome Back</h5>
                                    <br>
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>Email address</label>
                                    <input type="email" name="email" placeholder="Enter email" value="{{ old('email') }}" class="form-control input-no-border" required>
                                    @if ($errors->has('email'))
                                      <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                      </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Password" class="form-control input-no-border" required>
                                    @if ($errors->has('password'))
                                      <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                      </span>
                                    @endif
                                </div>
                                  
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-rose btn-wd btn-lg">Sign In</button>
                                <p>New to School?&nbsp;&nbsp;
                                    <a href="register.html">
                                <i class="ti-id-badge"></i> Register
                                    </a>
                                </p>

                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <footer class="footer">
          <div class="container-fluid">
              <p class="copyright pull-right">
                  &copy;
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
