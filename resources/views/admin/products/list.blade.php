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
    </div>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Menu name</th>
                <th>Price</th>
                <th>Price sale</th>
                <th>Active</th>
                <th>Image</th>
                <th>Last update</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->menu->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->price_sale }}</td>
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
