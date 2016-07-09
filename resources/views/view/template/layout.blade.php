<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>JWHelper - {{ $title or "undefined" }}</title>

    <link href="{{asset('css/bootstrap-orange.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/layout.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.ajaxfileupload.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/bootstrap-dialog.min.css')}}">
    <script src="{{asset('js/bootstrap-dialog.min.js')}}"></script>
    @yield('headjs')
  </head>

  <body>
    <br /><br /><br />
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://localhost/JWHelper/public/index"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> JiaoWu Helper</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">{{ $username or "undefined" }} {{ $role or "undefined" }}，欢迎您！</a></li>
            <li><a href="http://localhost/JWHelper/public/logout">注销</a></li>
            <li><a href="http://localhost/JWHelper/public/template/no-page">帮助</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
          <div class="col-sm-3 col-md-2 sidebar">
            @section('sidebar')
                
            @show
          </div>
          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @section('main_panel')
                
            @show
          </div>
        </div>
    </div>

    @yield('bodyJS')
  </body>

  <footer class="footer navbar-fixed-bottom navbar-default">
      <div class="container">
        <p class="text-muted" align="center" style="margin: 10px 0;">JWHelper v1.0 &copy; 2016 All Rights Reserved.</p>
      </div>
  </footer>
</html>