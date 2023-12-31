@extends('admin.users.main')
@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User name</th>
                <th>Email</th>
                <th>Quyền</th>
                <th>Last update</th>
                <th>Action</th>
            </tr>
        <tbody>
            @foreach ($users as $key => $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->roles == 1) Quản trị
{{--                        @elseif($user->roles == 2) Nhân Viên--}}
                        @else Người Dùng
                        @endif
                    </td>
                    <td>{{ $user->updated_at }}</td>
{{--                    @dd($user->roles)--}}
                        <td>
                            <a class="btn btn-primary btn-sm" href='/admin/users/edit/{{ $user->id }}'>
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm"
                               onclick="removeRow('{{ $user->id }}', '/admin/users/destroy')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>

                </tr>
            @endforeach
        </tbody>
        </thead>
    </table>
@endsection
