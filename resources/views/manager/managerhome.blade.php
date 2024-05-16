@extends('nav.header')

@section('content')


<div class="container">



    <div class="clearfix"></div>
   
</div>

    

</div>

<div class="container mt-5">

@if (Session::has('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
    </div>
    @endif
<table class="table">
    <thead>
        <tr>
            <th style="text-align:left;">ID</th>
            <th style="text-align:left;">Image</th>
            <th style="text-align:left;">Name</th>
            <th style="text-align:right;">Manufacturer</th>
            <th style="text-align:right;">Quantity</th>
            <th style="text-align:right;">Price</th>           
            <th style="text-align:center;">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->product_id }}</td>
            <td> <img src="data:image;base64,{{ $product->product_image }}" alt="image" id="preview" style="width: 40px; height: 40px;"/>
            </td>
            <td>{{ $product->product_name }}</td>

            <td style="text-align:right;"> {{ $product->manufacturer->manufacturer_name }}</td>
            <td style="text-align:right;">{{ $product->product_quantity }}</td>
            <td style="text-align:right;">{{ $product->product_price }}</td>
            <td style="text-align:center;">
                 <a href="{{ route('product.edit', ['id' => $product->product_id]) }}" class="btn btn-warning btn-sm">
                        <span class="material-icons">edit</span> Sửa
                    </a>
                    <a href="{{ route('deleteProduct', ['id' => $product->product_id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chăc muốn xóa?')">
                        <span class="material-icons">delete</span> Xóa
                    </a>
            </td>
        </tr>
        @endforeach
        
    </tbody>
</table>

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




@endsection