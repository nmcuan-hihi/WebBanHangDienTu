<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
</head>
<body>
    <h1>Invoice #{{ $invoiceData['invoice_number'] }}</h1>
    <p><strong>Date:</strong> {{ date('Y-m-d') }}</p>
    <p><strong>Customer Name:</strong> {{ $invoiceData['customer_name'] }}</p>
    <p><strong>Customer Address:</strong> {{ $invoiceData['customer_address'] }}</p>
    <p><strong>Customer Email:</strong> {{ $invoiceData['customer_email'] }}</p>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoiceData['cart'] as $item)
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
                <th colspan="3">Subtotal</th>
                <th>${{ number_format($invoiceData['subtotal'], 2) }}</th>
            </tr>
            <tr>
                <th colspan="3">Tax (10%)</th>
                <th>${{ number_format($invoiceData['tax'], 2) }}</th>
            </tr>
            <tr>
                <th colspan="3">Total</th>
                <th>${{ number_format($invoiceData['total'], 2) }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
