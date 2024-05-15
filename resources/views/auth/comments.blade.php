@extends('nav.header')

@section('content')
<div class="container">
    <h5>Comments for Product: {{ $product->product_name }}</h5>
    <div class="row">
        <div class="col-md-12">
            @if($comments->isEmpty())
                <p>chưa có bình luận nào cả hehe</p>
            @else
                @foreach($comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">                       
                        <p class="card-text">{{ $comment->comment_content }}</p>
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
        <form action="#" method="post" class="d-flex">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
            <input type="text" name="comment_content" class="form-control me-2" placeholder="Enter your comment...">
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
</div>
@endsection
