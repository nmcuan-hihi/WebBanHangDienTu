@extends('nav.header')

@section('content')
<div class="container mt-5">
    <div class="row">


        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Thêm mới danh mục
                </div>
                <div class="card-body">
                    <form action="{{ route('category.add') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Tên danh mục:</label>
                            <input type="text" class="form-control" id="category_name" name="category_name">
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>


            <h2>List of category</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Acition</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->category_name }}</td>

                            <td>
                                <a href="{{ route('edit.category', ['category' => $category->category_id]) }}" class="btn btn-info btn-sm">
                                    <span class="material-icons icon-small">edit</span> Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
                    </div>
                @endif
                <div class="card-header">
                    Danh sách danh mục
                </div>
                <div class="card-body">
                    <ul class="list-group">
                       
                                @foreach($categories as $category)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $category->category_name }}
                                        <form action="{{ route('deleteCategory', ['id' => $category->category_id]) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc muốn xóa?')">
                                                <span class="material-icons">delete</span> Xóa
                                            </button>
                                        </form>
                                    </li>
                                @endforeach
                          
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection