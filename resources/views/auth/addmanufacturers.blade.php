@extends('nav.header')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Manufacturer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #dc3545;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Add Manufacturer</h1>
        <form action="{{ route('store.manufacturer') }}" method="POST">
            @csrf
            <label for="manufacturer_name">Manufacturer Name:</label>
            <input type="text" id="manufacturer_name" name="manufacturer_name">

            <label for="manufacturer_phone">Manufacturer Phone:</label>
            <input type="text" id="manufacturer_phone" name="manufacturer_phone">

            <label for="manufacturer_email">Manufacturer Email:</label>
            <input type="email" id="manufacturer_email" name="manufacturer_email">

            <button type="submit">Add Manufacturer</button>
        </form>

        <!-- Kiểm tra và hiển thị thông báo -->
        @if(Session::has('error'))
            <div class="error-message">{{ Session::get('error') }}</div>
        @endif
        @if(Session::has('success'))
            <div class="success-message">{{ Session::get('success') }}</div>
        @endif

     
        <h2>List of Manufacturers</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($manufacturers as $manufacturer)
                        <tr>
                            <td>{{ $manufacturer->manufacturer_name }}</td>
                            <td>{{ $manufacturer->manufacturer_phone }}</td>
                            <td>{{ $manufacturer->manufacturer_email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>
<style>
    .table-container {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
}

tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

tbody tr:hover {
    background-color: #ddd;
}

</style>

@endsection