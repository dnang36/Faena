@extends('admin.users.main')
@section('content')
    <div class="dropdown">
        <form class="float-right">
            Tìm kiếm: <input type="search" name="q" value="" placeholder="Nhập Enter để tìm kiếm">
        </form>

        <a href="{{ route('menu.add') }}" class="btn btn-success">
            + Thêm Danh mục
        </a>
        <hr>
    </div>

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
