@extends('nav.header')

@section('content')
<div class="container mt-4">
    <div class="row">
        @if (Session::has('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
        </div>
        @endif
        <!-- Card sản phẩm bên phải -->
        <div class="col-md-4">
            <div class="card mb-3" style="border: 1px solid black;">
                <img src="data:image;base64,{{ $product->product_image }}" class="card-img-top" alt="Product Image" style="height: 340px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->product_name }}</h5>
                    <p class="card-text">${{ $product->product_price }}</p>

                </div>
            </div>
        </div>
        <!-- Phần bình luận -->
        <div class="col-md-8">
            <h5>Comments for Product: {{ $product->product_name }}</h5>
            @if($comments->isEmpty())
            <p>No comments yet.</p>
            @else
            @foreach($comments as $comment)
            <div class="card mb-3" style="height: 60px;">
                <div class="card-body d-flex justify-content-between">
                    <p class="card-text">{{ $comment->comment_content }}</p>
                    @if(Auth::check() && $comment->user_id == Auth::user()->id)
                    <form action="{{ route('delete.comment') }}" method="post" class="delete-form">
                        @csrf
                        <input type="hidden" name="id" value="{{$comment->comment_id}}">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chăc muốn xóa?')">x</button>
                    </form>
                    @endif
                </div>
            </div>
            @endforeach


            @endif

        </div>
    </div>
</div>

<!-- Fixed bottom bar for comment input -->
<div class="fixed-bottom bg-light p-3">
    <div class="container">
        <form action="{{ route('send.comment') }}" method="post" class="d-flex">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
            <input type="text" name="comment_content" class="form-control me-2" placeholder="Enter your comment...">
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
</div>
@endsection