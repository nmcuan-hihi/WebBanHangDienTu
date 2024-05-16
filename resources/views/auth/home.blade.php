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
                <a href="{{ route('showProductDetail', ['id' => $product->product_id]) }}"><h5 class="card-title">{{ $product->product_name }}</h5></a>
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
    @if ($products->hasPages())
        <nav aria-label="Page navigation">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($products->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @php
                    // Maximum number of pages to display
                    $maxPages = 5;
                    // Calculate start and end page numbers
                    $startPage = max($products->currentPage() - floor($maxPages / 2), 1);
                    $endPage = min($startPage + $maxPages - 1, $products->lastPage());
                @endphp

                @for ($i = $startPage; $i <= $endPage; $i++)
                    <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Next Page Link --}}
                @if ($products->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>



<div class="clearfix"></div>

@endsection