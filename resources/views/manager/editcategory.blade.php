@extends('nav.header')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Sửa danh mục
                </div>
                <div class="card-body">
                    <form action="{{ route('category.edit.post', ['id' => $category->category_id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Tên danh mục:</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $category->category_name }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
