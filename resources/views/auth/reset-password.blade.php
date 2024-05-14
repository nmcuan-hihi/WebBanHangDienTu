@extends('nav.header')

@section('content')


<main class="login-form mt-5">
  <div class="cotainer">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card" style="border: 2px solid black;">
          <h3 class="card-header bg-dark text-center text-light">Change Password</h3>
          <div class="card-body">
            <div class="container">
            
             
              <form action="{{ route('reset.password.post') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mb-3 mt-3">
                  <label for="email" class="form-label">Email:</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password:</label>
                  <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                </div>

                <div class="mb-3">
                  <label for="password" class="form-label">Password:</label>
                  <input type="password" class="form-control" id="password" placeholder="Enter password" name="password_confirmation">
                </div>
               
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