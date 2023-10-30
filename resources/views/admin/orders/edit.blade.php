@extends('admin.users.main')
@section('content')

    <body class="hold-transition sidebar-mini">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <strong>Thông tin khách hàng</strong>
                                        <small class="float-right">Ngày:
                                            {{ now()->format('d/m/Y') }}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <address>
                                        <strong>Tên người nhận: {{ $customer->cus_name }}</strong><br>
                                        Địa chỉ: {{ $customer->address }}<br>
                                        Phone: {{ $customer->phone_number }}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Hóa đơn #007612</b><br>
                                    <b>Mã đơn hàng: </b>{{ $customer->id }} <br>
                                    <b>Ngày: </b>{{ $customer->created_at->format('d/m/Y H:m:s') }}<br>
                                </div>
                                <!-- /.col -->
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Mã sản phẩm</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá</th>
                                                <th>Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @php
                                                    $total = 0;
                                                @endphp
                                                @foreach ($products as $key => $product)
                                                    @php
                                                        $total += $product->price * $product->quantity;
                                                    @endphp
                                            <tr>
                                                <td>{{ $product->product_id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->quantity }}</td>
                                                <td>
                                                    {{ number_format($product->price, 0, ',', '.') }}<sup>đ</sup>
                                                </td>
                                                <td>
                                                    {{ number_format($product->price * $product->quantity, 0, ',', '.') }}<sup>đ</sup>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p class="lead">Ghi chú:</p>
                                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        {{ $customer->note }}
                                    </p>
                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                    <p class="lead">Cập nhật ngày: {{ now()->format('d/m/Y') }}</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Tổng: </th>
                                                <td>{{ number_format($total, 0, ',', '.') }}<sup>đ</sup></td>
                                            </tr>
                                            @if (!is_null($customer->voucher_id))
                                                <tr>
                                                    <th>Giảm giá</th>
                                                    <td>-
                                                        {{ number_format($total * ($customer->voucher->discount / 100), 0, ',', '.') }}<sup>đ</sup>
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <th>Phí vận chuyển: </th>
                                                <td>30.000<sup>đ</sup></td>
                                            </tr>
                                            <tr>
                                                <th>Tổng thanh toán: </th>
                                                <td>{{ number_format($customer->voucher_id == null ? $total : $total * (1 - $customer->voucher->discount / 100) + 30000, 0, ',', '.') }}<sup>đ</sup>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="">
                                <div class="row no-print">
                                    <div class="col-12">
                                        <a href="/admin/orders/list" class="btn btn-default float-right"><i
                                                class="fas fa-arrow-left"></i>
                                            Quay
                                            lại</a>
                                        <button type="submit" class="btn btn-success"
                                            onclick="return confirm('Bạn có muốn chuyển trạng thái đơn hàng này?')"> Chuyển
                                            trạng thái
                                        </button>
                                        <select name="status">
                                            <option value="0" {{ $customer->status == 0 ? 'selected' : '' }}>Đang chờ
                                            </option>
                                            <option value="1" {{ $customer->status == 1 ? 'selected' : '' }}>Đang giao
                                            </option>
                                            <option value="2" {{ $customer->status == 2 ? 'selected' : '' }}>Đã giao
                                            </option>
                                            <option value="3" {{ $customer->status == 3 ? 'selected' : '' }}>Đã hủy
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{ $customer->id }}">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
@endsection
