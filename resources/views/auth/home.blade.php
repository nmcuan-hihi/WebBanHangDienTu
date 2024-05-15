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

<!-- Hiển thị sản phẩm -->
<div class="container mt-3">
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="data:image;base64,{{ $product->product_image }}" alt="Product Image" class="card-img-top" style="height: 200px; object-fit: cover;">
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
    <ul class="pagination">
        @php
            $currentPage = $products->currentPage();
            $lastPage = $products->lastPage();
            $startPage = max($currentPage - 2, 1);
            $endPage = min($currentPage + 2, $lastPage);
        @endphp

        @if ($products->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
        @else
            <li class="page-item"><a href="{{ $products->url(1) }}" class="page-link">&laquo;</a></li>
        @endif

        @if ($products->onFirstPage())
            <li class="page-item disabled"><span class="page-link">Previous</span></li>
        @else
            <li class="page-item"><a href="{{ $products->previousPageUrl() }}" class="page-link"><</a></li>
        @endif

        @for ($i = $startPage; $i <= $endPage; $i++)
            <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                <a href="{{ $products->url($i) }}" class="page-link">{{ $i }}</a>
            </li>
        @endfor

        @if ($products->hasMorePages())
            <li class="page-item"><a href="{{ $products->nextPageUrl() }}" class="page-link">></a></li>
        @else
            <li class="page-item disabled"><span class="page-link">Next</span></li>
        @endif

        @if ($products->hasMorePages())
            <li class="page-item"><a href="{{ $products->url($lastPage) }}" class="page-link">&raquo;</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
        @endif
    </ul>
</div>



<div class="clearfix"></div>

@endsection