@extends('nav.header')

@section('content')
<div class="container">
    <div class="">
        <div class="">
            <div class="card mt-5">
                <div class="card-header">Thông tin người dùng</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                          
                            <img src="data:image;base64,{{ $user->image }}" alt="image" style="width: 400px; height: 400px;" />
                        </div>
                        <div class="col-md-7">
                            <h4>Name: {{ $user->name }}</h4>
                            <p><strong>Email: </strong> {{ $user->email }}</p>
                            <p><strong>Phone: </strong> {{ $user->phone }}</p>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
