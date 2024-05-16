@extends('nav.header')

@section('content')


<main class="login-form mt-5">
  <div class="cotainer">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card" style="border: 2px solid black;">
          <h3 class="card-header bg-dark text-center text-light">LOGIN</h3>
          <div class="card-body">
            <div class="container">
              <!-- kiểm tra xem có bất kỳ lỗi nào được trả về không -->
              @if ($errors->any())
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          <!-- lỗi đầu tiên của trường 'login' -->
          <strong> {{ $errors->first('login') }}</strong>
        </div>
      @endif
              <form action="{{ route('user.checkUser') }}" method="POST">
                @csrf

                <div class="mb-3 mt-3">
                  <label for="email" class="form-label">Email:</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password:</label>
                  <input type="password" class="form-control" id="password" placeholder="Enter password"
                    name="password">
                </div>
                <!-- <div class="form-check mb-3">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember"> Remember me
                  </label>
                </div> -->
                <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection