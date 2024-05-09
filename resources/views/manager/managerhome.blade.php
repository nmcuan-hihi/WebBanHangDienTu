@extends('nav.header')

@section('content')

<div class="container mt-5">
    @if (Session::has('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
    </div>
    @endif

    

</div>
@endsection