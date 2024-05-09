@extends('nav.header')

@section('content')
<div class="container">
    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="id" type="hidden" value="{{$user->id}}">
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" value="{{ $user->name }}" name="name">
        </div>
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email }}" name="email">
        </div>
        <div class="mb-3">
            <div class="mb-3 mt-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" value="{{ $user->phone }}" name="phone">
            </div>
            <div class="form-group">
                <img src="data:image;base64,{{ $user->image }}" alt="image" id="preview" style="width: 60px; height: 60px;"/>

                Select image to upload:
                <input type="file" name="image" id="image" onchange="previewImage(this);">
            </div>
           
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" placeholder="Password" id="password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
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
