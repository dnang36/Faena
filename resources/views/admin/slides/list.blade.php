@extends('admin.users.main')
@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Slider</th>
                <th>Url</th>
                <th>Ảnh</th>
                <th>Thứ tự sắp xếp</th>
                <th>Trạng thái</th>
                <th>Last update</th>
                <th>Hành động</th>
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
