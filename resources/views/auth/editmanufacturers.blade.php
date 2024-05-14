@extends('nav.header')

@section('content')

<div class="container mt-5">
    <h1>Edit Manufacturer</h1>
    <form action="{{ route('update.manufacturer', $manufacturer->manufacturer_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="manufacturer_name">Manufacturer Name:</label>
            <input type="text" class="form-control" id="manufacturer_name" name="manufacturer_name" value="{{ $manufacturer->manufacturer_name }}">
        </div>
        <div class="form-group">
            <label for="manufacturer_phone">Manufacturer Phone:</label>
            <input type="text" class="form-control" id="manufacturer_phone" name="manufacturer_phone" value="{{ $manufacturer->manufacturer_phone }}">
        </div>
        <div class="form-group">aas
            <label for="manufacturer_email">Manufaacturer Email:</label>
            <input type="email" class="form-control" id="manufacturer_email" name="manufacturer_email" value="{{ $manufacturer->manufacturer_email }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Manufacturer</button>
    </form>
</div>

@endsection
