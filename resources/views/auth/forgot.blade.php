@extends('nav.header')

@section('content')

<main class="login-form mt-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card" style="border: 2px solid black;">
          <h3 class="card-header bg-dark text-center text-light">Forgot Password</h3>
          <div class="card-body">
            <div class="container">
              @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif

              @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
              @endif

              <form action="{{ route('forgot.password.link') }}" method="POST">
                @csrf

                <div class="mb-3 mt-3">
                  <label for="email" class="form-label">Email:</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">Send Email</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
