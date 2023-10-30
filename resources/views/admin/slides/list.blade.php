@extends('admin.users.main')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Url</th>
                <th>Image</th>
                <th>Sort by</th>
                <th>Active</th>
                <th>Last update</th>
                <th>Action</th>
            </tr>
        <tbody>
            @foreach ($slides as $key => $slide)
                <tr>
                    <td>{{ $slide->id }}</td>
                    <td>{{ $slide->name }}</td>
                    <td>{{ $slide->url }}</td>
                    <td><a href="{{ $slide->thumb }}"><img src="{{ $slide->thumb }}" width="50px" height="50px" /></a></td>
                    <td>{{ $slide->sort_by }}</td>
                    <td>{!! App\Helpers\Helper::active($slide->active) !!}</td>
                    <td>{{ $slide->updated_at }}</td>
                    <td><a class="btn btn-primary btn-sm" href='/admin/slides/edit/{{ $slide->id }}'>
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm"
                            onclick="removeRow('{{ $slide->id }}', '/admin/slides/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </thead>
    </table>
@endsection
