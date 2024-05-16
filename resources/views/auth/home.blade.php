@extends('nav.header')

@section('content')

<div class="container mt-3">
    @if (Session::has('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
        </div>
    @endif
    <form id="filterForm" action="{{ route('filterProducts') }}" method="GET">
        <div class="d-flex mb-3">
            <div class="form-group mr-2">
                <label for="category" class="mr-2">Select Category:</label>
                <select name="category" id="category" class="form-control mr-2">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mr-2">
                <label for="sort" class="mr-2">Sort by Price:</label>
                <select name="sort" id="sort" class="form-control mr-2">
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>🔼 Ascending</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>🔽 Descending</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" style="height: 40px;">Apply Filter</button>
    </form>
</div>



<div class="row justify-content-end">
    
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
                    <button class="btn btn-outline-success" type="submit"><span
                            class="material-icons">search</span></button>
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







<div class="clearfix"></div>

<div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            @if ($products->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
                <li class="page-item"><a href="{{ $products->previousPageUrl() }}" class="page-link">&laquo;</a></li>
            @endif

            @for ($i = 1; $i <= $products->lastPage(); $i++)
                <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}"><a
                        href="{{ $products->url($i) }}" class="page-link">{{ $i }}</a></li>
            @endfor

            @if ($products->hasMorePages())
                <li class="page-item"><a href="{{ $products->nextPageUrl() }}" class="page-link">&raquo;</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
            @endif
        </ul>
    </nav>
</div>


@endsection