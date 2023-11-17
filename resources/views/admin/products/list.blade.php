@extends('admin.users.main')
@section('content')
    <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Lọc
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{ route('product.list') }}">Tất cả</a>
            @foreach ($menus as $key => $menu)
                <a class="dropdown-item"
                    href="{{ request()->fullUrlWithQuery(['category' => $menu->id]) }}">{{ $menu->name }}</a>
            @endforeach
        </div>
        <form class="float-right">
            Tìm kiếm: <input type="search" name="q" value="{{ $search }}" placeholder="Nhập Enter để tìm kiếm">
        </form>

        <a href="{{ route('product.add') }}" class="btn btn-success">
            + Thêm sản phẩm
        </a>

    </div>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Danh mục Sản phẩm</th>
                <th>Giá gốc</th>
                <th>Giá giảm</th>
                <th>Trạng Thái</th>
                <th>Ảnh</th>
                <th>Last update</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->menu->name }}</td>
                    <td>{{ number_format($product->price, 0, ',','.') }}<sup>đ</sup></td>
                    <td>{{ number_format($product->price_sale, 0, ',','.') }}<sup>đ</sup></td>
                    <td>{!! App\Helpers\Helper::active($product->active) !!}</td>
                    <td><a href="{{ $product->thumb }}"><img src="{{ $product->thumb }}" width="50px"
                                height="50px" /></a>
                    </td>
                    <td>{{ $product->updated_at }}</td>
                    <td><a class="btn btn-primary btn-sm" href='/admin/products/edit/{{ $product->id }}'>
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm"
                            onclick="removeRow('{{ $product->id }}', '/admin/products/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (count($products) > 0)
        {{ $products->links() }}
    @endif
@endsection
