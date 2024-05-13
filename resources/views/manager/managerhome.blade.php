@extends('nav.header')

@section('content')

<div class="container mt-5">
    @if (Session::has('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
    </div>
    @endif

    <a href="{{ route('addcategory') }}" class="btn btn-info btn-sm">
        <span class="material-icons">visibility</span> Thêm danh mục
    </a>
    

</div>
@endsection