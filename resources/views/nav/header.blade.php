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
          @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Sign up</a>
          </li>
          @else
          @if(Auth::user()->role == 'custom')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('purchase.history') }}">Lịch sử mua hàng</a>
          </li>
          @elseif(Auth::user()->role == 'admin')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('backmanager') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('addproduct') }}">Thêm sản phẩm</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('add.manufacturer') }}">Thêm nhà cung cấp</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href=" {{ route('addcategory') }}">Thêm danh mục</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('manageruser') }}">Quản Lý User</a>
          </li>
          @endif
          @endguest
        </ul>
        <ul class="navbar-nav ms-auto">
         
          @auth
          <li class="nav-item">
            <span class="nav-link">Login: {{ Auth::user()->email }}</span>
          </li>
          @if(Auth::user()->role == 'custom')
          <li class="nav-item">
            <a href="{{ route('cart') }}" class="nav-link">
              <span class="material-icons">shopping_cart</span>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="{{ route('signout') }}">
              <span class="material-icons">logout</span>
            </a>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>
  @yield('content')
</body>

</html>