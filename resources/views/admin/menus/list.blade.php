@extends('admin.users.main')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Active</th>
                <th>Last Update</th>
                <th>Action</th>
            </tr>
        <tbody>
            {!! App\Helpers\Helper::menu($menus) !!}
        </tbody>
        </thead>
    </table>
    {{ $menus->links() }}
@endsection
