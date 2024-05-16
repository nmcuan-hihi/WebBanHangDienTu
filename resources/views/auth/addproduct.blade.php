@extends('nav.header')

@section('content')
<body>
    <div class="container">
        <h1>Add Product</h1>
        <form action="{{ route('store.product') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" class="form-control" id="product_name" name="product_name">
            </div>

            <div class="form-group">
                <label for="category_id">Category:</label>
                <select class="form-control" id="category_id" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="manufacturer_id">Manufacturer ID:</label>
                <select class="form-control" id="manufacturer_id" name="manufacturer_id">
                    @foreach($manufacturers as $manufacturer)
                        <option value="{{ $manufacturer->manufacturer_id }}">{{ $manufacturer->manufacturer_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="product_image">Product Image:</label>
                <input type="file" class="form-control-file" id="product_image" name="product_image">
            </div>

            <div class="form-group">
                <label for="product_price">Product Price:</label>
                <input type="text" class="form-control" id="product_price" name="product_price">
            </div>

            <div class="form-group">
                <label for="warranty_period">Warranty Period:</label>
                <input type="text" class="form-control" id="warranty_period" name="warranty_period">
            </div>

            <div class="form-group">
                <label for="product_quantity">Product Quantity:</label>
                <input type="text" class="form-control" id="product_quantity" name="product_quantity">
            </div>

            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</body>
@endsection
