@extends('nav.header')

@section('content')
    <div class="container">
        <h1>Invoice Details</h1>
        <p><strong>Invoice ID:</strong> {{ $invoice->invoice_id }}</p>
        <p><strong>Total Amount:</strong> {{ $invoice->total_amount }}</p>
        <p><strong>Payment Method:</strong> {{ $invoice->invoice_payment ? 'Paid' : 'Unpaid' }}</p>
        <p><strong>Date:</strong> {{ $invoice->created_at->format('Y-m-d') }}</p>

        <h2>Customer Information</h2>
        @if ($userProfile)
            <p><strong>Name:</strong> {{ $userProfile->name }}</p>
            <p><strong>Phone:</strong> {{ $userProfile->phone }}</p>
        @else
            <p><strong>Customer profile not found.</strong></p>
        @endif

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
                @php
                    $totalBeforeTax = $detail->product ? $detail->product->product_price * $detail->invoice_details_quantity : 0;
                    $tax = $totalBeforeTax * 0.10;
                    $totalAfterTax = $totalBeforeTax + $tax;
                @endphp
                <tr>
                    <td>{{ $detail->product ? $detail->product->product_name : 'Product not available' }}</td>
                    <td>{{ $detail->product ? $detail->product->product_price : 'N/A' }}</td>
                    <td>{{ $detail->invoice_details_quantity }}</td>
                    <td>{{ number_format($totalAfterTax, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    
@endsection
