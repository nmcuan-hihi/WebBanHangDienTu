@extends('nav.header')

@section('content')
<div class="container mt-5">
    @if (Session::has('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
    </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Avatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Sex</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td><img src="data:image;base64,{{ $user->userProfile->image }}" alt="image" style="width: 50px; height: 50px;" /></td>
                <td>{{ $user->userProfile->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->userProfile->phone }}</td>
                <td>{{ $user->userProfile->address }}</td>
                <td>{{ $user->userProfile->sex }}</td>
                <td>{{ $user->role }}</td>
                <td>
<<<<<<< HEAD
                <a href="{{ route('user.showitem', ['id' => $user->id]) }}" class="btn btn-warning btn-sm">
                <span class="material-icons">visibility</span> Chi tiết
                    <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-warning btn-sm">
                        <span class="material-icons">edit</span> Sửa
=======
                   
                    <a href="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chăc muốn xóa?')">
                        <span class="material-icons">delete</span> Xóa
>>>>>>> Thu_deleteUser
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                @if (!$users->onFirstPage())
                <li class="page-item">
                    <a href="{{ $users->previousPageUrl() }}" class="page-link">
                        <span aria-hidden="true">
                            << /span>
                    </a>
                </li>
                @endif
                @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                </li>
                @endforeach
                @if ($users->hasMorePages())
                <li class="page-item">
                    <a href="{{ $users->nextPageUrl() }}" class="page-link" aria-label="Next">
                        <span aria-hidden="true">></span>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
@endsection