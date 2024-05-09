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



                            <div class="row">
                                <h4>Danh sách bài viết đã viết</h4>
                                <table>
                                    <thead>
                                        <th>ID</th>
                                        <th>Post name</th>
                                    </thead>
                                    <tbody>
                                        @foreach($user->posts as $post)
                                        <tr>
                                            <td>{{ $post->post_id }}</td>
                                            <td>{{ $post->post_name }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                            <div class="row">
                                <h4>Danh sách Sở Thích</h4>
                                <table>
                                    <thead>
                                       
                                        <th>Sở thích</th>
                                        <th>Mô tả</th>
                                    </thead>
                                    <tbody>
                                        @foreach($user->favorities as $fav)
                                        <tr>
                                            <td>{{ $fav->favorite_name }}</td>
                                            <td>{{ $fav->favorite_description }}</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="container">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection