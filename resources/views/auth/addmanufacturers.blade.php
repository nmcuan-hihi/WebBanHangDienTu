@extends('nav.header')

@section('content')

<body>
    <div class="container">
        <!-- Biểu mẫu tìm kiếm -->
        <form action="{{ route('manufacturer.search') }}" method="GET" id="searchForm" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by manufacturer name..." id="manufacturer_name" name="manufacturer_name">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </form>

        <h1>Add Manufacturer</h1>
        <form action="{{ route('store.manufacturer') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="manufacturer_name">Manufacturer Name:</label>
                <input type="text" class="form-control" id="manufacturer_name" name="manufacturer_name">
            </div>

            <div class="form-group">
                <label for="manufacturer_phone">Manufacturer Phone:</label>
                <input type="text" class="form-control" id="manufacturer_phone" name="manufacturer_phone">
            </div>

            <div class="form-group">
                <label for="manufacturer_email">Manufacturer Email:</label>
                <input type="email" class="form-control" id="manufacturer_email" name="manufacturer_email">
            </div>
            <button type="submit" class="btn btn-primary">Add Manufacturer</button>
        </form>

        <!-- Kiểm tra và hiển thị thông báo -->
        @if(Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <h2>List of Manufacturers</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Acition</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($manufacturers as $manufacturer)
                        <tr>
                            <td>{{ $manufacturer->manufacturer_name }}</td>
                            <td>{{ $manufacturer->manufacturer_phone }}</td>
                            <td>{{ $manufacturer->manufacturer_email }}</td>
                            <td>
                                <a href="{{ route('edit.manufacturer', $manufacturer->manufacturer_id) }}" class="btn btn-info btn-sm">
                                    <span class="material-icons icon-small">edit</span> Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</body>

@endsection
