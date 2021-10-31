<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Demo</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-light bg-dark shadow p-3 mb-5 bg-body">
    <a href="{{ url('/') }}" class="navbar-brand text-light"><h2><b>Demo Blogger</b></h2></a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav medium">
            <a class="nav-item nav-link text-light" href="{{ url('/') }}">Home</a>
            <a class="nav-item nav-link text-light" href="{{ url('/about') }}">About Us</a>
            <a class="nav-item nav-link text-light" href="{{ url('/contact') }}">Contact Us</a>
        </div>
        <div class="navbar-nav ml-auto">
            @if (Auth::guest())
                <a class="nav-item nav-link mr-1 text-light" href="{{ url('/auth/login') }}">Login</a>
                <a class="nav-item nav-link btn btn-success mr-1 text-light" style="width: 75px"
                   href="{{ url('/auth/register') }}">Register</a>
            @else
                @if (Auth::user()->is_admin())
                    <a class="nav-item nav-link text-light" href="{{ url('/admin') }}">Admin Dashboard</a>
                @endif
                @if (Auth::user()->can_post())
                    <a class="nav-item nav-link text-light" href="{{ url('/new-post') }}">Add new post</a>
                    <a class="nav-item nav-link text-light" href="{{ url('/user/'.Auth::id().'/posts') }}">My Posts</a>
                @endif
                <a class="nav-item nav-link text-light" href="{{ url('/user/'.Auth::id()) }}">My Profile</a>
                <a class="nav-item nav-link text-light" href="{{ url('/logout') }}">Logout</a>
            @endif
        </div>
    </div>

</nav>
{{-- <div class="navbar-header bg-dark shadow p-3 mb-5 bg-body float-end justify-content-end">
  <p class="navbar-text navbar-right actions">
    <a class="btn btn-primary btn-md mr-1 mx-auto" style="width: 150px" href="{{ url('/') }}">Home</a>
    @if (Auth::guest())
      <a class="btn btn-primary btn-md mr-1 mx-auto" style="width: 150px" href="{{ url('/auth/login') }}">Login</a>
      <a class="btn btn-primary btn-md mr-1 mx-auto" style="width: 150px" href="{{ url('/auth/register') }}">Register</a>
    @else
      @if (Auth::user()->can_post())
        <a class="btn btn-primary btn-md mr-1 mx-auto" style="width: 150px" href="{{ url('/new-post') }}">Add new post</a>
        <a class="btn btn-primary btn-md mr-1 mx-auto" style="width: 150px" href="{{ url('/user/'.Auth::id().'/posts') }}">My Posts</a>
      @endif
      <a xclass="btn btn-primary btn-md mr-1 mx-auto" style="width: 150px" href="{{ url('/user/'.Auth::id()) }}">My Profile</a>
      <a class="btn btn-primary btn-md mr-1 mx-auto" style="width: 150px" href="{{ url('/auth/logout') }}">Logout</a>
    @endif
  </p>
</div>  --}}
<div class="container">
    @if (Session::has('message'))
        <div class="flash alert-info">
            <p class="panel-body">
                {{ Session::get('message') }}
            </p>
        </div>
    @endif
    @if ($errors->any())
        <div class='flash alert-danger'>
            <ul class="panel-body">
                @foreach ( $errors->all() as $error )
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>@yield('title')</h2>
                    @yield('title-meta')
                </div>
                <div class="panel-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
