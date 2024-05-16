<!DOCTYPE html>
<html>

<head>
    <title>NMCUAN-Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .fixed-top {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
    </style>
</head>

<body style="padding-top: 60px;">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <div class="container container-fluid">
            <a class="navbar-brand" href="#">NMCUAN-HIHI</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Sign up</a>
                    </li>

            </div>
        </div>
    </nav>
</body>

</html>


<div class="container mt-2">
    @if (Session::has('errors'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ Session::get('errors') }}
    </div>
    @endif

    <body>
        <h1>Verify Token</h1>
        <form action="{{ route('manager') }}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') }}">
            <label for="token">Enter the token sent to your email:</label>
            <input type="text" name="token" required>
            <button type="submit">Verify</button>
        </form>
    </body>
</div>
