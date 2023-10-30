@extends('admin.customers.main')
@section('head')
    <link rel="stylesheet" type="text/css" href="/template/admin/css/aodabong2.css">
    <link rel="stylesheet" type="text/css" href="/template/admin/css/grid.css">
    <link rel="stylesheet" type="text/css" href="/template/admin/css/slider.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
@endsection

@section('content')
    {{-- slide --}}
    <div class="slider">
        <div class="list-danhmuc">
            <div class="danhmuc" style="align-items: center">
                <div class="text-top"><i class="fas fa-bars"></i>&ensp;DANH MỤC SẢN PHẨM
                </div>
                @foreach ($menuParents as $key => $menuPar)
                    @if ($key == 0)
                        <br>
                        <div class="option"><a
                                href="/danh-muc/{{ $menuPar->id . '-' . Str::slug($menuPar->name, '-') }}/"><i
                                    class="fas fa-arrow-circle-right"></i>&ensp;{{ $menuPar->name }}</a>
                        </div>
                    @else
                        <hr>
                        <div class="option"><a
                                href="/danh-muc/{{ $menuPar->id . '-' . Str::slug($menuPar->name, '-') }}/"><i
                                    class="fas fa-arrow-circle-right"></i>&ensp;{{ $menuPar->name }}</a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @if (count($slides) > 0)
            <div class="slideshow-container">
                @foreach ($slides as $key => $slide)
                    <div class="mySlides">
                        <img class="slide-img" src="{{ $slide->thumb }}">
                    </div>
                @endforeach
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
        @endif
    </div>
    <div class="block-content">
        @foreach ($products as $keyMenu => $id)
            <br>
            <div class="block-text-1">
                <div class="block-text-left"><a class="btn-left"
                        href="/danh-muc/{{ $id[0]->menu_id . '-' . Str::slug($keyMenu, '-') }}/">&ensp;<i
                            class="far fa-futbol"></i>&ensp;{{ $keyMenu }}&emsp;</a></div>
                <div class="block-text-right"><a class="btn-right"
                        href="/danh-muc/{{ $id[0]->menu_id . '-' . Str::slug($keyMenu, '-') }}/">Xem
                        thêm <i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></a></div>
            </div>
            <div class="block-4 d-flex flex-wrap">
                @foreach ($id as $key => $product)
                    <div class="block-product">
                        <a href="/san-pham/{{ $product->id . '-' . Str::slug($product->name, '-') }}">
                            <img src="{{ $product->thumb }}" /></a>
                        <a href="/san-pham/{{ $product->id . '-' . Str::slug($product->name, '-') }}">
                            <p>{{ $product->name }}</p>
                        </a>
                        @if ($product->price != 0)
                            {!! App\Helpers\Helper::price($product->price, $product->price_sale) !!}
                        @endif
                        <br>
                        <br>
                        <a class="detail"
                            href="/san-pham/{{ $product->id . '-' . Str::slug($product->name, '-') }}"> Chi
                            tiết</a>
                        <br>&ensp;
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    <br>
{{--    <div class="block-feature">--}}
{{--        <div class="features">--}}
{{--            <div class="feature">--}}
{{--                <div class="in-feature"><i class="fas fa-tshirt"></i></div>&ensp;--}}
{{--                <div class="in-feature">--}}
{{--                    <div class="text-top">SẢN PHẨM ĐA DẠNG</div>--}}
{{--                    <div class="text-bot">Cung cấp nhiều mẫu mã đẹp</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="feature">--}}
{{--                <div class="in-feature"><i class="fas fa-trophy"></i></div>&ensp;--}}
{{--                <div class="in-feature">--}}
{{--                    <div class="text-top">CHẤT LƯỢNG CAO</div>--}}
{{--                    <div class="text-bot">Giá thành hợp lý</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="feature">--}}
{{--                <div class="in-feature"><i class="fas fa-dolly-flatbed"></i></div>&ensp;--}}
{{--                <div class="in-feature">--}}
{{--                    <div class="text-top">GIAO HÀNG SIÊU TỐC</div>--}}
{{--                    <div class="text-bot">Giao hàng ngay sau khi đặt mua</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="feature">--}}
{{--                <div class="in-feature"><i class="fas fa-handshake"></i></div>&ensp;--}}
{{--                <div class="in-feature">--}}
{{--                    <div class="text-top">CHÍNH SÁCH ƯU ÁI</div>--}}
{{--                    <div class="text-bot">Chính sách bảo hành dài hạn</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
@section('foot')
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);
        currentSlide(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
        }
        var index = 1;

        changeSlides = function() {
            var slides = document.getElementsByClassName("mySlides");

            if (index > slides.length) {
                index = 1
            }
            if (index < 1) {
                index = slides.length
            }
            for (var i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[index - 1].style.display = "block";
            index++;
        }
        setInterval(changeSlides, 3000);
    </script>
@endsection
