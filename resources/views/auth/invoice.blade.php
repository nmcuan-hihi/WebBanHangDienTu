@extends('nav.header')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-4">Hóa Đơn</h1>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Chi Tiết Hóa Đơn</h5>
                    <p class="card-text"><strong>Số Hóa Đơn:</strong> {{ $invoice_number ?? '0001' }}</p>
                    <p class="card-text"><strong>Ngày:</strong> {{ date('Y-m-d') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-md-right">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Chi Tiết Thanh Toán</h5>
                    <p class="card-text">
                        {{ $customer_name ?? 'Van Duc' }}<br>
                        {{ $customer_address ?? 'Thủ Đức, Tp.HCM' }}<br>
                        {{ $customer_email ?? 'nhomz9@gmail.com' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Tên</th>
                <th>Giá</th>
                <th>Số Lượng</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>${{ number_format($item['price'], 2) }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">Tổng Cộng</th>
                <th>${{ number_format($subtotal, 2) }}</th>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Thuế (10%)</th>
                <th>${{ number_format($tax, 2) }}</th>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Tổng Thanh Toán</th>
                <th>${{ number_format($total, 2) }}</th>
            </tr>
        </tfoot>
    </table>
    <div class="row mt-4">
        <div class="col-md-12 text-md-right">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Phương Thức Thanh Toán</h5>
                    <p class="card-text">{{ $payment_method ?? 'Thẻ Tín Dụng' }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 text-md-right">
        <form action="{{ route('finalize.purchase') }}" method="POST">
            @csrf
            <input type="hidden" name="cart" value="{{ json_encode($cart) }}">
            <input type="hidden" name="subtotal" value="{{ $subtotal }}">
            <input type="hidden" name="tax" value="{{ $tax }}">
            <input type="hidden" name="total" value="{{ $total }}">
            <input type="hidden" name="invoice_number" value="{{ $invoice_number }}">
            <input type="hidden" name="customer_name" value="{{ $customer_name }}">
            <input type="hidden" name="customer_address" value="{{ $customer_address }}">
            <input type="hidden" name="customer_email" value="{{ $customer_email }}">
            <input type="hidden" name="payment_method" value="{{ $payment_method }}">
            <button type="submit" class="btn btn-success">Mua hàng</button>
        </form>
        </div>
    </div>
</div>
@endsection
