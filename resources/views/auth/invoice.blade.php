@extends('nav.header')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-4">Invoice</h1>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Invoice Details</h5>
                    <p class="card-text"><strong>Invoice #:</strong> {{ $invoice_number ?? '0001' }}</p>
                    <p class="card-text"><strong>Date:</strong> {{ date('Y-m-d') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-md-right">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Billing Details</h5>
                    <p class="card-text">
                        {{ $customer_name ?? 'John Doe' }}<br>
                        {{ $customer_address ?? '1234 Main St, Anytown, USA' }}<br>
                        {{ $customer_email ?? 'john.doe@example.com' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
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
                <th colspan="3" class="text-right">Subtotal</th>
                <th>${{ number_format($subtotal, 2) }}</th>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Tax (10%)</th>
                <th>${{ number_format($tax, 2) }}</th>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Grand Total</th>
                <th>${{ number_format($total, 2) }}</th>
            </tr>
        </tfoot>
    </table>
    <div class="row mt-4">
        <div class="col-md-12 text-md-right">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Payment Method</h5>
                    <p class="card-text">{{ $payment_method ?? 'Credit Card' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <form id="sendInvoiceForm">
                @csrf
                <div class="form-group">
                    <label for="email">Nhập email của bạn:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary">Gửi</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#sendInvoiceForm').on('submit', function(event) {
        event.preventDefault();
        
        var formData = {
            _token: $('input[name="_token"]').val(),
            email: $('#email').val(),
            invoice_number: '{{ $invoice_number ?? '0001' }}',
            date: '{{ date('Y-m-d') }}',
            customer_name: '{{ $customer_name ?? 'John Doe' }}',
            customer_address: '{{ $customer_address ?? '1234 Main St, Anytown, USA' }}',
            customer_email: '{{ $customer_email ?? 'john.doe@example.com' }}',
            cart: @json($cart),
            subtotal: {{ $subtotal }},
            tax: {{ $tax }},
            total: {{ $total }},
            payment_method: '{{ $payment_method ?? 'Credit Card' }}'
        };

        $.ajax({
            url: '{{ route('send.invoice') }}',
            method: 'POST',
            data: formData,
            success: function(response) {
                alert('Hóa đơn đã được gửi qua email!');
            },
            error: function(xhr, status, error) {
                alert('Đã xảy ra lỗi khi gửi hóa đơn. Vui lòng thử lại.');
            }
        });
    });
});
</script>
@endsection
