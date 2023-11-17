<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="/template/admin/css/chitietdonhang.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="tbl-hd">
        <table cellspacing="0" class="table table-bordered">
            <tbody>
                <caption>ĐƠN ĐẶT HÀNG</caption>
                <tr>
                    <td colspan="3">Ngày: {{ $customer->created_at }}</td>
                    <td colspan="3">Mã đơn hàng: {{ $customer->id }}</td>
                </tr>
                <tr>
                    <td colspan="6">Tên người nhận: {{ $customer->cus_name }}</td>
                </tr>
                <tr>
                    <td colspan="6">Email: {{ $customer->email }}</td>
                </tr>
                <tr>
                    <td colspan="6">Địa chỉ: {{ $customer->address }}</td>
                </tr>
                <tr>
                    <td colspan="6">Số điện thoại: {{ $customer->phone_number }}</td>
                </tr>
                <tr>
                    <td colspan="6">Ghi chú: {{ $customer->note }}</td>
                </tr>

                <tr class="row-txt ">
                    <td class="col-txt">Mã sản phẩm</td>
                    <td class="col-txt">Tên sản phẩm</td>
                    <td class="col-txt">Số lượng</td>
                    <td class="col-txt">Đơn giá</td>
                    <td class="col-txt">Thành tiền</td>
                </tr>
                @php
                    $total = 0;
                @endphp

                @foreach ($products as $key => $product)
                    @php
                        $price_new = $product->price != 0 ? $product->price : $product->price;
                        $total += $price_new * $carts[$product->id];
                    @endphp
                    <tr>
                        <td class="col-infor">{{ $product->id }}</td>
                        <td class="col-infor1">{{ $product->name }}</td>
                        <td class="col-infor">{{ $carts[$product->id] }}</td>
                        <td class="col-infor">{{ $price_new }}<sup>đ</sup></td>
                        <td class="col-infor2">
                            {{ number_format($carts[$product->id] * $price_new, 0, ',', '.') }}<sup>đ</sup>
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="4"></td>
                    <td style="float: right;">--</td>
                </tr>
                <tr>
                    <td colspan="3" rowspan="5">Ghi chú:......................</td>
                    <td>Tổng</td>
                    <td class="col-infor2">
                        {{ number_format($total, 0, ',', '.') }}<sup>đ</sup>
                    </td>
                </tr>
                @if (!is_null($customer->voucher_id))
                    <tr>
                        <td>Giảm giá</td>
                        <td class="col-infor2">-
                            {{ number_format($total * ($customer->voucher->discount / 100), 0, ',', '.') }}<sup>đ</sup>
                        </td>
                    </tr>
                @endif
                <tr>
                    <td>Phí vận chuyển: </td>
                    <td class="col-infor2">30.000<sup>đ</sup></td>
                </tr>
                <tr>
                    <td>Tổng thanh toán: </td>
                    <td class="col-infor2">
                        {{ number_format($customer->voucher_id == null ? $total : $total * (1 - $customer->voucher->discount / 100) + 30000, 0, ',', '.') }}<sup>đ</sup>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <br>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
