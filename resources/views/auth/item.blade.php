@extends('nav.header')

@section('content')

<div class="container">
    <div class="">
        <div class="">
            <div class="card mt-5">
                <div class="card-header">Thông Tin Sản Phẩm</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">

                            <img src="data:image;base64,{{ $product->product_image }}" alt="image" style="width: 400px; height: 400px;" />
                        </div>
                        <div class="col-md-7">
                            <h4>Name: {{ $product->product_name }}</h4>
                            <p><strong>Price: </strong> {{ $product-> product_price }}</p>

                        </div>
                        <div class="container">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection