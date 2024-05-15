@extends('nav.header')

@section('content')
    <div class="container">
        <h1>Invoice Details</h1>
        <p><strong>Invoice ID:</strong> {{ $invoice->invoice_id }}</p>
        <p><strong>Total Amount:</strong> {{ $invoice->total_amount }}</p>
        <p><strong>Payment Method:</strong> {{ $invoice->invoice_payment ? 'Paid' : 'Unpaid' }}</p>
        <p><strong>Date:</strong> {{ $invoice->created_at->format('Y-m-d') }}</p>

        <h2>Customer Information</h2>
        <p><strong>Name:</strong> {{ $invoice->user->user_id }}</p>
        <p><strong>Email:</strong> {{ $invoice->user->email }}</p>
       

        <h2>Products</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($invoiceDetails as $detail)
                <tr>
                    <td>{{ $detail->product_name }}</td>
                    <td>{{ $detail->product_price }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->price * $detail->quantity }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
