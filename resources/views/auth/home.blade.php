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
<div class="py-3">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($products as $product)
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="data:image;base64,{{ $product->product_image }}" alt="Product Image" style="height: 300px; object-fit: cover;">
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">{{ $product->product_name }}</h5>
                            <!-- Product price-->
                            <p class="card-text">${{ $product->product_price }}</p>
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="row">
                            <div class="col-md-3">
                                <form action="{{ route('cart') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                    <input type="hidden" name="product" value="{{ json_encode($product) }}">
                                    <div class="text-center"><button type="submit" class="btn btn-outline-dark mt-auto">Buy</button></div>
                                </form>
                            </div>
                            <div class="col-md-9">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route('view.comment', ['id' => $product->product_id]) }}">Comment</a></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            @endforeach
        </div>
    </div>
</div>




<div class="d-flex justify-content-center">
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
        <li class="page-item"><a href="{{ $products->previousPageUrl() }}" class="page-link">
                << /a>
        </li>
        @endif

        @for ($i = $startPage; $i <= $endPage; $i++) <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
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