@extends('admin.customers.main')
@section('head')
    <link rel="stylesheet" type="text/css" href="/template/admin/css/chitietsp.css">
@endsection
@section('content')
    <div class="block-head-2">
        <div class="head-text">
            <a href="{{ route('home') }}">Trang chủ</a> >><a href="">
                Sản phẩm
            </a> >> {{ $product->name }}
        </div>
    </div>
    <div class="block-content">
        <div class="block-content-1">
            <div class="block-content-1-left">
                <div class="detail-pro">
                    <img width="400px" height="400px" src="{{ $product->thumb }}" />
{{--                    <div class="block-khuyenmai">--}}
{{--                        <div class="khuyenmai"><i class="far fa-star"></i> Tặng ngay quả bóng đá, giày bóng đá,--}}
{{--                            găng--}}
{{--                            tay thủ môn, phụ kiện bóng--}}
{{--                            đá ... tùy theo số lượng đặt in.<br><i class="fas fa-truck-pickup"></i> Miễn phí SHIP--}}
{{--                            TOÀN--}}
{{--                            QUỐC khi đặt--}}
{{--                            ONLINE với hóa đơn trên 3 triệu.<br>--}}
{{--                            <i class="fa fa-fire"></i> Cùng nhiều khuyến mãi--}}
{{--                            hấp dẫn khác đang chờ bạn khám phá ^^--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="block-content-1-right">
                <p class="text-1">{{ $product->name }}</p>
                <a href="#" class="text-2">{!! App\Helpers\Helper::price($product->price, $product->price_sale) !!}</a>
                <form method="POST" action="/add-cart">
                    <div class="block-soluong">
                        <label>Số lượng: </label>
                        <input type="button" onclick="tru()" value="-" class="button">
                        <input class="soluong" type="text" value="1" id="quantity" readonly name="quantity">
                        <input type="button" onclick="cong()" value="+" class="button">
                    </div>
                    <br>
                    @if ($product->price != 0)
                        <div class="btn-giohang">
                            <button class="giohang" type="submit" id="add"><i class="fas fa-cart-plus"></i>&ensp;Thêm
                                vào
                                giỏ
                            </button>
                        </div>
                    @endif
                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                    @csrf
                </form>
                <script type="text/javascript">
                    var sl = document.getElementById('quantity').value;

                    function tru() {
                        if (sl == 1) {
                            document.getElementById('quantity').value = 1;
                        } else {
                            sl--;
                            document.getElementById('quantity').value = sl;
                        }
                    }

                    function cong() {
                        sl++;
                        document.getElementById('quantity').value = sl;
                    }
                </script>

{{--                <a href="#" class="text-2">{!! App\Helpers\Helper::price($product->price, $product->price_sale) !!}</a>--}}
                <hr>

                <div class="text-3">Hàng chính hãng, chứng nhận an toàn</label>
                </div>
                <div class="text-3">Giao hàng toàn quốc & nhanh chóng</label>
                </div>
                <div class="text-3">Liên hệ hỗ trợ: <label>0334858070</label></div>
                <hr>
{{--                <p class="text-4">(Nhận in từ 05 bộ trở lên - MIỄN PHÍ IN)</p>--}}
{{--                <div class="block-timework">--}}
{{--                    <i class="fas fa-hand-point-right"></i> Mỗi sản phẩm được sản xuất nhiều chất liệu vải #--}}
{{--                    nhau - Tương ứng với mỗi mức giá #--}}
{{--                    nhau.<br>--}}
{{--                    <i class="far fa-clock"></i> Giờ làm việc: 9h00 - 20h00 (Tất cả các ngày)<br>--}}
{{--                    <i class="fas fa-truck-pickup"></i> Giao hàng toàn quốc: Từ 24 - 48h (cả thời gian in ấn)--}}
{{--                </div>--}}
            </div>
        </div>
        <br>
{{--        <div class="table-size">--}}
{{--            <table class="tbl-size" cellspacing="0">--}}
{{--                <th colspan="5">BẢNG SIZE ÁO BÓNG ĐÁ</th>--}}
{{--                <tr class="txt-head">--}}
{{--                    <td>Size Châu Á</td>--}}
{{--                    <td>M</td>--}}
{{--                    <td>L</td>--}}
{{--                    <td>XL</td>--}}
{{--                    <td></td>--}}
{{--                </tr>--}}
{{--                <tr class="txt-head">--}}
{{--                    <td>Size Châu Âu</td>--}}
{{--                    <td>S</td>--}}
{{--                    <td>M</td>--}}
{{--                    <td>L</td>--}}
{{--                    <td>XL</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td class="txt-head">Cân nặng</td>--}}
{{--                    <td>40 - 54 kg</td>--}}
{{--                    <td>55 - 65 kg</td>--}}
{{--                    <td>65 -76 kg</td>--}}
{{--                    <td>77 - 99 kg</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td class="txt-head">Chiều cao</td>--}}
{{--                    <td>1m50 - 1m66</td>--}}
{{--                    <td>1m68 - 1m73</td>--}}
{{--                    <td>1m74 - 1m80</td>--}}
{{--                    <td>1m81 - 1m90</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td colspan="5" class="txt-end">(size XXL Châu Á chỉ áp dụng cho áo đặt may theo yêu cầu và--}}
{{--                        không có sẵn)</td>--}}
{{--                </tr>--}}
{{--            </table>--}}
{{--            &emsp;--}}
{{--            <div class="img-size">--}}
{{--                <img src="\template\admin\images\bangsize.jpg">--}}
{{--            </div>--}}
{{--        </div><br>--}}
        <div class="out-texthead">
            <div class="text-head">
                <i class="far fa-comment-dots"></i>&ensp;ĐÁNH GIÁ SẢN PHẨM
            </div>
        </div>
        <form method="POST" action="/add-comment">
            <div class="block-comment">
                <div class="enter-comment">
                    <div class="head-comment">
                        <div class="txt-cmt">Viết bình luận ..... <i class="fas fa-pencil-alt"></i></div>
                    </div>
                    <div class="content-comment">
                        <textarea name="content" class="content-comment" rows="4" cols="60" placeholder="Nhập đánh giá của bạn vào đây...">
                                                                                                                                                                                                                                            </textarea><br>
                        <button type="submit" class="btn-send"
                            onclick=" return confirm('Gửi bình luận?')"></i>Gửi</button>
                    </div>
                </div>
            </div>
            <input type="hidden" value="{{ Session::get('user') }}" name="user_name">
            <input type="hidden" value="{{ $product->id }}" name="product_id">
            @csrf
        </form>
        @foreach ($comments as $key => $comment)
            <div class="comment">
                <div class="user-img"><img src="/template/admin/images/user.jpg"></div>
                &ensp;
                <div class="infor-comment">
                    {{ $comment->user->name }}<br>
                    <div class="name-user"><a href="#"></a>Lúc {{ $comment->created_at->format('d/m/Y') }}
                    </div>
                    <div class="line-comment">{{ $comment->content }}</div>
                    @if (Session::get('user') == $comment->user->name)
                        <a href="/delete-comment/{{ $comment->id }}"
                            onclick="return confirm('Bạn có muốn xóa đánh giá này?')" class="delete-comment">Xóa
                        </a>
                    @endif
                </div>
            </div>
            <br>
        @endforeach
        <br>
        <div class="block-text-1">
            <div class="block-text-left"><a class="btn-left" href="#">&ensp;<i class="far fa-futbol"></i>&ensp;Sản
                    phẩm liên quan&emsp;</a></div>
        </div>
        <div class="d-flex flex-wrap" id="block-4">
            @foreach ($products as $key => $pro)
                @if ($product->id != $pro->id)
                    <div class="block-img">
                        <div class="img">
                            <a href="/san-pham/{{ $pro->id . '-' . Str::slug($pro->name, '-') }}"><img
                                    src="{{ $pro->thumb }}" /><a>
                                    <a href="/san-pham/{{ $pro->id . '-' . Str::slug($pro->name, '-') }}">
                                        <p style="padding-top: 5px">{{ $pro->name }}</p><a>
                                            @if ($product->price != 0)
                                                {!! App\Helpers\Helper::price($product->price, $product->price_sale) !!}
                                            @endif
                        </div>
                        <div class="btn-out">
                            <div class="btn-group">
                                <a class="detail"
                                    href="/san-pham/{{ $pro->id . '-' . Str::slug($pro->name, '-') }}"> Chi
                                    tiết</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
@section('foot')
@endsection
