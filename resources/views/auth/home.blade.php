@extends('nav.header')

@section('content')


<div class="container mt-5">
    <!-- @if (Session::has('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
    </div>
    @endif -->




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
                        <form action="#" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                            <input type="hidden" name="product" value="{{ json_encode($product) }}">
                            <button type="submit" class="btn btn-info btn-sm">
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