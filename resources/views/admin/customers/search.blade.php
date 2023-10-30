@extends('admin.customers.main')
@section('head')
    <link rel="stylesheet" type="text/css" href="/template/admin/css/danhsachsp.css">
@endsection
@section('content')
    <div class="block-content">
        <div class="block-head-2">
            <div class="head-text">
                <a href="{{ route('home') }}">Trang chủ</a> >> {{ request()->input('content-search') }}
            </div>
        </div>
        <div class="block-text-1">
            <div class="block-text-left"><a class="btn-left" href="#">&ensp;<i class="far fa-futbol"></i>&ensp;Danh sách
                    tìm kiếm&emsp;</a></div>
            <div class="block-text-right"><a class="btn-right" href="#">Xem
                    thêm <i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></a></div>
        </div>

        @if (count($products) > 0)
            <div class="d-flex flex-wrap" id="block-4">
                @foreach ($products as $key => $product)
                    <div class="block-img">
                        <div class="img">
                            <a href="/san-pham/{{ $product->id . '-' . Str::slug($product->name, '-') }}"><img
                                    src="{{ $product->thumb }}" /><a>
                                    <a href="/san-pham/{{ $product->id . '-' . Str::slug($product->name, '-') }}">
                                        <p style="padding-top: 5px">{{ $product->name }}</p><a>
                                            @if ($product->price != 0)
                                                {!! App\Helpers\Helper::price($product->price, $product->price_sale) !!}
                                            @endif
                        </div>
                        <div class="btn-out">
                            <div class="btn-group">
                                <a class="detail"
                                    href="/san-pham/{{ $product->id . '-' . Str::slug($product->name, '-') }}"> Chi
                                    tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <br>
            <div class="thongbao"> <i class="far fa-frown-open"></i>&ensp;KHÔNG TÌM THẤY SẢN PHẨM THEO YÊU
                CẦU!</div><br>
        @endif
        <div class="block-text-1">
            <div class="block-text-left"><a class="btn-left" href="#">&ensp;<i class="far fa-futbol"></i>&ensp;Các
                    sản phẩm khác&emsp;</a></div>
            <div class="block-text-right"><a class="btn-right" href="#">Xem
                    thêm <i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></a></div>
        </div>
        <div class="d-flex flex-wrap" id="block-4">
            @foreach ($others as $key => $product)
                <div class="block-img">
                    <div class="img">
                        <a href="/san-pham/{{ $product->id . '-' . Str::slug($product->name, '-') }}"><img
                                src="{{ $product->thumb }}" /><a>
                                <a href="/san-pham/{{ $product->id . '-' . Str::slug($product->name, '-') }}">
                                    <p style="padding-top: 5px">{{ $product->name }}</p><a>
                                        @if ($product->price != 0)
                                            {!! App\Helpers\Helper::price($product->price, $product->price_sale) !!}
                                        @endif
                    </div>
                    <div class="btn-out">
                        <div class="btn-group">
                            <a class="detail"
                                href="/san-pham/{{ $product->id . '-' . Str::slug($product->name, '-') }}"> Chi
                                tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
