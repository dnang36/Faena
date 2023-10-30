@extends('admin.users.main')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Tên khách hàng</th>
                <th>Nội dung</th>
                <th>Thời gian</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $comment)
                <tr>
                    <td>{{ $comment->product->name }}</td>
                    <td>{{ $comment->user->name }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->updated_at }}</td>
                    <td><a class="btn btn-primary btn-sm"
                            href="/san-pham/{{ $comment->product->id . '-' . Str::slug($comment->product->name, '-') }}">
                            <i class=" fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm"
                            onclick="removeRow('{{ $comment->id }}', '/admin/comments/delete')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $comments->links() }}
@endsection
