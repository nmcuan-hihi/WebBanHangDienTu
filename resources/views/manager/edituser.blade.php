@extends('nav.header')

@section('content')
<div class="container">
    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="id" type="hidden" value="{{$user->id}}">
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" value="{{ $user->userProfile->name }}" name="name">
        </div>
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email }}" name="email">
        </div>
        <div class="mb-3">
            <div class="mb-3 mt-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" value="{{ $user->userProfile->phone }}" name="phone">
            </div>
            <div class="form-group">
                <img src="data:image;base64,{{ $user->userProfile->image }}" alt="image" id="preview" style="width: 60px; height: 60px;" />

                Select image to upload:
                <input type="file" name="image" id="image" onchange="previewImage(this);">
            </div>
            <div class="mb-3 mt-3">
                <label for="favorities" class="form-label">Address:</label>
                <input type="text" class="form-control" id="address" value="{{ $user->userProfile->address }}" name="address">
            </div>

            <div class="mb-3">
                <label for="sex" class="form-label">{{ __('Sex') }}</label>
                <select id="sex" class="form-control @error('sex') is-invalid @enderror" name="sex">
                    <option value="male" {{ $user->userProfile->sex == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                    <option value="female" {{ $user->userProfile->sex == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                </select>

                @error('sex')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">{{ __('Role') }}</label>
                <select id="role" class="form-control @error('role') is-invalid @enderror" name="role">
                    <option value="custom" {{ $user->role == 'custom' ? 'selected' : '' }}>{{ __('User') }}</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>{{ __('Admin') }}</option>
                </select>

                @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
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