@extends('admin.customers.main')
@section('head')
    <link href="/template/admin/css/giohang.css" type="text/css" rel="stylesheet">
@endsection
@section('content')
    <div class="block-head-2">
        <div class="head-text">
            <a href="/">Trang chủ</a> >> Giỏ hàng
        </div>
    </div>
    <div class="block-content">
        <br>
        <div class="in-content">
            <div class="content-top">
                <div class="out-texthead">
                    <div class="text-head">
                        <i class="fas fa-shopping-basket"></i>&ensp;THÔNG TIN GIỎ HÀNG CỦA BẠN
                    </div>
                </div>
                @php
                    $total = 0;
                @endphp
                @if (count($products) > 0)
                    <table cellspacing="0" class="table-product">
                        <thead class="tbl-text-head">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <form method="POST">
                            <tbody>

                                @foreach ($products as $key => $product)
                                    @php
                                        $price_new = $product->price_sale != 0 ? $product->price_sale : $product->price;
                                        $total += $price_new * $carts[$product->id];
                                    @endphp
                                    <tr>
                                        <td class="col-img"><img src="{{ $product->thumb }}"></td>
                                        <td class="col-dongia"><input type="text"
                                                value="{{ number_format($price_new, 0, ',', '.') }}đ" id="dongia"
                                                class="money" readonly="readonly">
                                        </td>
                                        <td class="col-soluong">
                                            <input type="button" onclick="tru({{ $price_new }}, {{ $product->id }})"
                                                value="-" class="button">
                                            <input class="soluong" type="text" value="{{ $carts[$product->id] }}"
                                                id="quantity{{ $product->id }}" name="num_product[{{ $product->id }}]"
                                                readonly>
                                            <input type="button" onclick="cong({{ $price_new }}, {{ $product->id }})"
                                                value="+" class="button">
                                        </td>
                                        <td class="col-thanhtien">
                                            <input type="text"
                                                value="{{ number_format($price_new * $carts[$product->id], 0, ',', '.') }}đ"
                                                id="money{{ $product->id }}" class="money" readonly>
                                            <input type="hidden" value="0" id="money" readonly>
                                        </td>
                                        <td class="col-thaotac">
                                            <div class="in-thaotac"><a onclick="return confirm('Bạn có muốn xóa?')"
                                                    href="/carts/delete/{{ $product->id }}" class="info-product">
                                                    <i style="color: #ed1a29" class="fas fa-trash-alt"></i>
                                                </a>&emsp;
                                                <a href="/san-pham/{{ $product->id . '-' . Str::slug($product->name, '-') }}"
                                                    class="info-product">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr style="border: none">
                                    <td colspan="4" style="text-align: right; padding: 10px 0px">
                                        <input class="btn-update" type="submit" value="Cập nhật"
                                            formaction="/update-cart">
                                    </td>
                                </tr>
                                <tr style="border: none">
                                    <td colspan="5">
                                        <div class="total">Tổng tiền: <input type="text"
                                                value="{{ number_format($total, 0, ',', '.') }}đ" id="tongtien"
                                                class="tongtien" readonly="readonly" name="tongtien"></div>
                                    </td>
                                </tr>
                            </tbody>
                            @csrf
                        </form>
                    </table>
                @else
                    <div class="row-end-money">
                        <span>Giỏ hàng hiện đang trống</span>
                        <input type="hidden" name="tongtien">
                    </div>
                @endif
            </div>
            <br>
            <div class="button-home">
                <a class="btn-home" href="/">
                    <i class="fas fa-arrow-left"></i> Tiếp tục mua hàng </a>
            </div>
            <br>
        </div>
        <div class="content-bot">
            <div class="out-texthead">
                <div class="text-head">
                    <i class="fas fa-dolly-flatbed"></i>&ensp;THÔNG TIN GIAO HÀNG
                </div>
                <div class="text-head">
                    <i class="fas fa-dollar-sign"></i>&ensp;THANH TOÁN
                </div>
            </div>
            <div class="row">
                <div class="information col-7">
                    <div class="text-hint">* Vui lòng nhập đầy đủ thông tin để chúng tôi giao hàng được chính xác,
                        cảm
                        ơn!</div>
                    <div class="input-text"><input id="ten" type="text" placeholder="Tên đầy đủ của bạn" required>
                        <p>*</p>
                    </div>
                    <div class="input-text"><input id="email" type="email" placeholder="Email của bạn" required>
                        <p>*</p>
                    </div>
                    <div class="text-hint">* Địa chỉ nhận hàng</div>
                    <div class="input-text"><input id="sonha" type="text"
                            placeholder="Số nhà, đường, (tòa nhà), phường/xã..." required>
                        <p>*</p>
                    </div>
                    <div class="input-text"><input id="sdt" type="number" placeholder="Số điện thoại" required>
                        <p>*</p>
                    </div>
                    <div class="text-hint">* Ghi chú</div>
                    <textarea id="mota" rows="2" cols="60" placeholder="Giao cho tôi vào giờ hành chính">{{ old('note') }}</textarea><br>

{{--                    @if (Session::has('carts') && count(Session::get('carts')) > 0)--}}
{{--                        <button onclick="openForm()" class="btn-buy"><i class="fas fa-dollar-sign"></i>--}}
{{--                            Mua--}}
{{--                            hàng</button>--}}
{{--                        <form action="{{ url('/vnpay_payment') }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            <br>--}}
{{--                            <input type="hidden" name="total" value="{{ $total }}">--}}
{{--                            <button class="btn btn-primary" name="redirect" type="submit">Thanh toán VNPay</button>--}}
{{--                        </form>--}}
{{--                    @endif--}}
                </div>
                <div class="information col-5">
                    <br>
                    @if ($total != 0)
                        <table class="table-payment">
                            <tr>
                                <td><label>Voucher</label></td>
                                <td class="col-voucher">
                                    <select onchange="addDiscount('{{ Session::get('user') }}')" id="select"
                                        class="select2" style="width:100%;">
                                        <option value="">
                                            Không
                                        </option>
                                        @foreach ($vouchers as $voucher)
                                            <option value="{{ $voucher->discount }}">
                                                {{ $voucher->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Phí vận chuyển</td>
                                <td class="col-infor2">30.000đ</td>
                            </tr>
                            <tr>
                                <td>Mã giảm giá</td>
                                <td class="col-infor2"><input readonly value="0" id="discount">đ</td>
                            </tr>
                            <tr class="tongtien">
                                <td><label>Tổng thanh toán</label></td>
                                <td class="col-infor2">
                                    <input readonly value="0" id="total">đ
                                </td>
                            </tr>
                        </table>
                    @endif
                    @if (Session::has('carts') && count(Session::get('carts')) > 0)
                        <button onclick="openForm()" class="btn-buy"><i class="fas fa-dollar-sign"></i>
                           Mua Hàng</button>
                        <form action="{{ url('/vnpay_payment') }}" method="POST">
                            @csrf
                            <br>
                            <input type="hidden" name="total" value="{{ $total }}">
                            <button class="btn btn-primary" name="redirect" type="submit">Thanh toán VNPay</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="form-popup" id="myForm">
        <form method="POST" action="/carts/confirm" class="form-container">
            <h3>Xác nhận Thanh Toán</h3>
            <table class="table-confirm">
                <tr>
                    <td><label><b>Họ tên</b></label></td>
                    <td><input type="text" class="form-control" id="ten2" name="cus_name" readonly></td>
                </tr>
                <tr>
                    <td><label><b>Email</b></label></td>
                    <td><input type="email" class="form-control" id="email2" name="email" readonly></td>
                </tr>
                <tr>
                    <td><label><b>Địa chỉ</b></label></td>
                    <td><input type="text" class="form-control" id="sonha2" name="address" readonly></td>
                </tr>
                <tr>
                    <td><label><b>Số điện thoại</b></label></td>
                    <td><input type="text" class="form-control" id="sdt2" name="phone_number" readonly></td>
                </tr>
                <tr>
                    <td><label><b>Tổng tiền</b></label></td>
                    <td><input type="text" class="form-control" id="total2" name="total" readonly></td>
                </tr>
                <tr>
                    <td><label><b>Ghi chú</b></label></td>
                    <td><input type="text" class="form-control" id="mota2" name="note" readonly></td>
                </tr>
            </table>
            <button type="submit" class="btn"><i class="fas fa-save"></i>&ensp;Thanh toán khi nhận hàng</button>
            <a class="btn" onclick="closeForm()"><i class="fas fa-window-close"></i>&ensp;Đóng</a>
            <input type="hidden" id="voucher_id" name="voucher_id">
            @csrf
        </form>
{{--        <form action="{{ url('/vnpay_payment') }}" method="POST">--}}
{{--            @csrf--}}
{{--            <br>--}}
{{--            <input type="hidden" name="total" value="{{ $total }}">--}}
{{--            <button class="btn btn-primary btn-vnp" name="redirect" type="submit">Thanh toán VNPay</button>--}}
{{--        </form>--}}
    </div>
    {{-- <script src="/template/admin/js/cart.js"></script> --}}
    <script type="text/javascript">
        var select = document.getElementById('select');
        var total = document.getElementById('total');
        var discount = document.getElementById('discount');
        var m = {{ $total }};

        total.value = formatCash(String(m + 30000));

        function addDiscount(user) {
            if (!user) {
                alert('Bạn cần đăng nhập để sử dụng voucher!');
            } else {
                var d = select.options[select.selectedIndex].value;
                discount.value = '- ' + formatCash(String(m * d / 100));
                total.value = formatCash(String(m - m * d / 100 + 30000));
            }
        }

        function getCash(str) {
            alert(str);
        }

        function openForm() {
            if (document.getElementById("ten").value == "") {
                alert("Chưa nhập họ tên!");
            } else if (document.getElementById("email").value == "") {
                alert("Chưa nhập email!");
            } else if (document.getElementById("sonha").value == "") {
                alert("Chưa nhập địa chỉ!");
            } else if (document.getElementById("sdt").value == "") {
                alert("Chưa nhập số điện thoại!");
            } else {
                var d = select.options[select.selectedIndex].value;
                @foreach ($vouchers as $voucher)
                    if (d == {{ $voucher->discount }})
                        document.getElementById("voucher_id").value = {{ $voucher->id }};
                @endforeach
                document.getElementById("ten2").value = document.getElementById("ten").value;
                document.getElementById("email2").value = document.getElementById("email").value;
                document.getElementById("sonha2").value = document.getElementById("sonha").value;
                document.getElementById("sdt2").value = document.getElementById("sdt").value;
                document.getElementById("mota2").value = document.getElementById("mota").value;
                document.getElementById("total2").value = document.getElementById("total").value + 'đ';
                document.getElementById("myForm").style.display = "block";
            }
            // document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }

        function tru(price, id) {
            var sl = document.getElementById('quantity' + id).value;
            if (sl == 1) {
                document.getElementById('quantity' + id).value = 1;
            } else {
                sl--;
                document.getElementById('quantity' + id).value = sl;
            }
            setPrice(price, id);
        }

        function cong(price, id) {
            var sl = document.getElementById('quantity' + id).value;
            sl++;
            document.getElementById('quantity' + id).value = sl;
            setPrice(price, id);
        }

        function setPrice(price, id) {
            var sl = document.getElementById('quantity' + id).value;
            document.getElementById('money' + id).value = formatCash(String(sl * price));
            // total(sl * price);
        }

        // function total(money) {
        //     var total = document.getElementById('tongtien').value;
        //     document.getElementById('tongtien').value = total;
        // }

        function formatCash(str) {
            return str.split('').reverse().reduce((prev, next, index) => {
                return ((index % 3) ? next : (next + '.')) + prev
            })
        }
    </script>
@endsection
