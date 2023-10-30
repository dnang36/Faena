@extends('admin.customers.main')
@section('head')
    <link rel="stylesheet" type="text/css" href="/template/admin/css/danhsachsp.css">
@endsection
@section('content')
    <div class="block-content">
        <div class="block-head-2">
            <div class="head-text">
                <a href="{{ route('home') }}">Trang chủ</a> >> {{ $menu->name }}
            </div>
            <div><a href="{{ request()->fullUrlWithQuery(['price' => 'asc']) }}">Giá tăng dần</a>
                <a href="{{ request()->fullUrlWithQuery(['price' => 'desc']) }}">Giá giảm dần</a>
            </div>
        </div>
        <div class="block-text-1">
            <div class="block-text-left"><a class="btn-left" href="#">&ensp;<i
                        class="far fa-futbol"></i>&ensp;{{ $menu->name }}&emsp;</a></div>
            <div class="block-text-right"><a class="btn-right" href="#">Xem
                    thêm <i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></a></div>
        </div>
        <div class="block-4 d-flex flex-wrap">
            @foreach ($products as $key => $product)
                <div class="block-product">
                    <a href="/san-pham/{{ $product->id . '-' . Str::slug($product->name, '-') }}">
                        <img src="{{ $product->thumb }}" /></a>
                    <a href="/san-pham/{{ $product->id . '-' . Str::slug($product->name, '-') }}">
                        <p style="padding-top: 5px">{{ $product->name }}</p>
                    </a>
                    @if ($product->price != 0)
                        {!! App\Helpers\Helper::price($product->price, $product->price_sale) !!}
                    @endif
                    <br>
                    <br>
                    <div class="btn-out">
                        <div class="btn-group">
                            <a class="detail"
                                href="/san-pham/{{ $product->id . '-' . Str::slug($product->name, '-') }}">
                                Chi
                                tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <br>
@endsection
