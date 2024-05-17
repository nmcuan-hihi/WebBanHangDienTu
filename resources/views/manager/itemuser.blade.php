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
                            @if($user->userProfile && isset($user->userProfile->image))
                            <img src="data:image;base64,{{ $user->userProfile->image }}" alt="Avatar" style="width:300px;height:300px;">
                            @else
                            <p>No image</p>
                            @endif
                        </div>

                        <div class="col-md-7">
                            <h5 class="card-title">{{ $user->userProfile->name ?? '' }}</h5>
                            <p class="card-text">Email: {{ $user->email }}</p>
                            <p class="card-text">Phone: {{ $user->userProfile->phone ?? '' }}</p>
                            <p class="card-text">Address: {{ $user->userProfile->address ?? '' }}</p>
                            <p class="card-text">Sex: {{ $user->userProfile->sex ?? '' }}</p>
                            <p class="card-text">Role: {{ $user->role }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="">
                <div class="card mt-5">
                    <div class="card-header">Các hóa đơn</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tổng số tiền</th>
                                    <th scope="col">Thanh toán</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->invoice as $item)
                                <tr>
                                    <td>{{ $item->invoice_id }}</td>
                                    <td>{{ $item->total_amount }}</td>
                                    <td>
                                        @if($item->invoice_payment == 0)
                                        Chưa thanh toán
                                        @elseif($item->invoice_payment == 1)
                                        Đã thanh toán
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection