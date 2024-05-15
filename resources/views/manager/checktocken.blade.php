@extends('nav.header')

@section('content')

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
@endsection