
@extends('nav.header')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="file"],
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Product</h1>
        <form action="{{ route('store.product') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="product_name">Product Name:</label><br>
            <input type="text" id="product_name" name="product_name"><br>

            <label for="category_id">Category ID:</label><br>
            <input type="text" id="category_id" name="category_id"><br>

            <label for="manufacturer_id">Manufacturer ID:</label><br>
            <input type="text" id="manufacturer_id" name="manufacturer_id"><br>

            <label for="product_image">Product Image:</label><br>
            <input type="file" id="product_image" name="product_image"><br>

            <label for="product_price">Product Price:</label><br>
            <input type="text" id="product_price" name="product_price"><br>

            <label for="warranty_period">Warranty Period:</label><br>
            <input type="text" id="warranty_period" name="warranty_period"><br>

            <label for="product_quantity">Product Quantity:</label><br>
            <input type="text" id="product_quantity" name="product_quantity"><br>

            <button type="submit">Add Product</button>
        </form>
    </div>
</body>
</html>
