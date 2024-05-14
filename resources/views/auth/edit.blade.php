@extends('nav.header')

@section('content')
<div class="container">
    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Input hidden để truyền id của user -->
        <input name="id" type="hidden" value="{{$user->id}}">
        <!-- Input để nhập tên của người dùng -->
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" value="{{ $user->name }}" name="name">
        </div>
        <!-- Input để nhập email của người dùng -->
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email }}" name="email">
        </div>
        <!-- Input để nhập số điện thoại của người dùng -->
        <div class="mb-3">
            <div class="mb-3 mt-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" value="{{ $user->phone }}" name="phone">
            </div>
            <!-- Input để chọn ảnh đại diện và hiển thị trước khi tải lên -->
            <div class="form-group">
                <img src="data:image;base64,{{ $user->image }}" alt="image" id="preview" style="width: 60px; height: 60px;"/>

                Select image to upload:
                <input type="file" name="image" id="image" onchange="previewImage(this);">
            </div>
           
            <!-- Input để nhập mật khẩu mới của người dùng -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" placeholder="Password" id="password" class="form-control" name="password">
            </div>
            <!-- Button để gửi biểu mẫu -->
            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <!-- Script để xem trước ảnh trước khi tải lên -->
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
</div>
@endsection
