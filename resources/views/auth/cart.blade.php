@extends('nav.header')

@section('content')
<div class="container pt-3">
    @if (Session::has('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
    </div>
    @endif
    @if(session('cart') && count(session('cart')) > 0)
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach(session('cart') as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>${{ $item['price'] }}</td>
                    <td>
                        <form action="{{ route('cart.updateQuantity') }}" method="post" class="d-flex">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                            <button type="submit" name="action" value="decrease" class="btn btn-sm btn-outline-primary">-</button>
                            <span class="mx-2">{{ $item['quantity'] }}</span>
                            <button type="submit" name="action" value="increase" class="btn btn-sm btn-outline-primary">+</button>
                        </form>
                    </td>
                    <td>${{ $item['price'] * $item['quantity'] }}</td>
                    <td>
                        <form action="{{ route('cart.remove') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                            <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>

    </table>
    <div class="alert alert-info text-center" role="alert">
        Giỏ hàng trống, hãy thêm các sản phẩm tốt của chúng tôi vào giở hàng nào ! Hehe
    </div>
    @endif
</div>
<div class="d-flex justify-content-end">
        <form action="{{ route('cart.purchase') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-success">Purchase</button>
        </form>
    </div>
@endsection
