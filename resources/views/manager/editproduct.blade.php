@extends('nav.header')

@section('content')

<div class="container mt-2">
    <h1>Edit Product</h1>
    <form action="{{ route('conflim.edit.product') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input value="{{ $product->product_name }}" type="text" id="product_name" name="product_name" class="form-control text-primary">
        </div>


            <div class="form-group">
                <label for="category_id">Category:</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="manufacturer_id">Manufacturer:</label>
                <select name="manufacturer_id" id="manufacturer_id" class="form-control">                
                    @foreach ($manufacturers as $manufacturer)
                        <option value="{{ $manufacturer->manufacturer_id }}">{{ $manufacturer->manufacturer_name }}</option>
                    @endforeach
                </select>
            </div>


        <div class="form-group">
        <img src="data:image;base64,{{ $product->product_image }}" alt="image" id="preview" style="width: 60px; height: 60px;"/>
            <label for="product_image">Product Image:</label>
            <input type="file" id="product_image" name="product_image" class="form-control-file" onchange="previewImage(this);">
        </div>

        <div class="form-group">
            <label for="product_price">Product Price:</label>
            <input value="{{ $product->product_price }}"  type="text" id="product_price" name="product_price" class="form-control  text-primary">
        </div>

        <div class="form-group">
            <label for="warranty_period">Warranty Period:</label>
            <input value="{{ $product->warranty_period }}" type="text" id="warranty_period" name="warranty_period" class="form-control  text-primary">
        </div>

        <div class="form-group">
            <label for="product_quantity">Product Quantity:</label>
            <input value="{{ $product->product_quantity }}" type="text" id="product_quantity" name="product_quantity" class="form-control  text-primary">
        </div>

        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>
<script>
        function previewImage(input) {
            var preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
