<!DOCTYPE html>
<html>

<head>
  <title>NMCUAN-Demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- <link href="{{ url('css/styles.css') }}?v=123" rel="stylesheet"> -->
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    td {
      height: 50px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container container-fluid">
      <a class="navbar-brand" href="#">NMCUAN-HIHI</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>



      <div class="collapse navbar-collapse " id="collapsibleNavbar">
        <ul class="navbar-nav">
          @guest
          <li class="nav-item">
            <a class="nav-link" href="#">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Sign up</a>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('signout') }}">Logout</a>
          </li>
          @endguest
        
        </ul>
      </div>





    </div>
  </nav>
  @yield('content')
</body>

</html>