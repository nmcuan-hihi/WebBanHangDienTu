@extends('nav.header')

@section('content')

<div class="container mt-5">
    <!-- @if (Session::has('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
    </div>
    @endif -->
    
    <div class="row justify-content-end">
        <div class="col-auto">
            <a href="{{ route('addproduct') }}" class="btn btn-info btn-sm">
                <span class="material-icons icon-small">add_circle</span> Add Product
            </a>
        </div>
        <div class="col-auto">
            <a href="{{ route('add.manufacturer') }}" class="btn btn-info btn-sm">
                <span class="material-icons icon-small">business</span> Add Manufacturers
            </a>
        </div>
        <div class="col-auto">
            <a href="{{ route('purchase.history') }}" class="btn btn-info btn-sm">
                <span class="material-icons icon-small">business</span> Lịch sử mua hàng
            </a>
        </div>
        <div class="col-auto">
            <form action="{{ route('product.search') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit"><span class="material-icons">search</span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="data:image;base64,{{ $product->product_image }}" alt="Product Image" class="card-img-top"
                        style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        <p class="card-text">Price: ${{ $product->product_price }}</p>
                        <form action="{{ route('cart') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                            <input type="hidden" name="product" value="{{ json_encode($product) }}">
                            <button type="submit" class="btn btn-info btn-sm btn-block">
                                <span class="material-icons icon-small">add_shopping_cart</span> Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            @if ($products->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
                <li class="page-item"><a href="{{ $products->previousPageUrl() }}" class="page-link">&laquo;</a></li>
            @endif

            @for ($i = 1; $i <= $products->lastPage(); $i++)
                <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}"><a href="{{ $products->url($i) }}"
                        class="page-link">{{ $i }}</a></li>
            @endfor

            @if ($products->hasMorePages())
                <li class="page-item"><a href="{{ $products->nextPageUrl() }}" class="page-link">&raquo;</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
            @endif
        </ul>
    </nav>
</div>

<div class="clearfix"></div>

@endsection
