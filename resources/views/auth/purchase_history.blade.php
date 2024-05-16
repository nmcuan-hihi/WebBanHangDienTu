@extends('nav.header')

@section('content')
<div class="container">
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h1>Purchase History</h1>
    @if ($invoices->isEmpty())
        <p>No purchase history found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>Username</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->invoice_id }}</td>
                        <td>{{ $invoice->   name }}</td>

                        <td>{{ $invoice->total_amount }}</td>
                        <td>{{ $invoice->invoice_payment ? 'Paid' : 'Unpaid' }}</td>
                        <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                        <td><a href="{{ route('invoice.detail', ['id' => $invoice->invoice_id]) }}">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
