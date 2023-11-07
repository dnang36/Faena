@extends('admin.users.main')
@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Trạng thái</th>
                <th>Last Update</th>
                <th>Hành động</th>
            </tr>
        <tbody>
            {!! App\Helpers\Helper::menu($menus) !!}
        </tbody>
        </thead>
    </table>
    {{ $menus->links() }}
@endsection
