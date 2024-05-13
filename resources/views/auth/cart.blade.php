@extends('nav.header')

@section('content')
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
                    <form action="{{ route('cart.updateQuantity') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                        <button type="submit" name="action" value="decrease">-</button>
                        <span>{{ $item['quantity'] }}</span>
                        <button type="submit" name="action" value="increase">+</button>
                    </form>
                </td>
                <td>${{ $item['price'] * $item['quantity'] }}</td>
                <td>
                    <form id="removeForm{{ $item['id'] }}" action="{{ route('cart.remove') }}" method="post" onsubmit="return confirmDelete()">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                        <button type="submit">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    function confirmDelete() {
        return confirm("Bạn có muốn xóa sản phẩm này không?");
    }
</script>


    </tbody>
</table>

<style>
    /* Add some basic styling to the table */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    /* Style the quantity input field */
    .input-group {
        display: flex;
        align-items: center;
    }

    .input-group button {
        border: none;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        padding: 5px 10px;
    }

    .input-group input {
        width: 40px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin: 0 5px;
    }

    /* Style the remove button */
    .btn-danger {
        background-color: #dc3545;
    }
</style>
@endsection
