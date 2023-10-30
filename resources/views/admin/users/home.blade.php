@extends('admin.users.main')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">CPU</span>
                    <span class="info-box-number">
                        10
                        <small>%</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="far fa-comment"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Bình luận</span>
                    <span class="info-box-number">{{ $sum_comment }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Số sản phẩm</span>
                    <span class="info-box-number">{{ $sum_product }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Thành viên</span>
                    <span class="info-box-number">{{ $sum_user }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title"><i class="fas fa-inbox"></i>&ensp;Đơn hàng mới</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Trạng thái</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            @php
                                $total = 0;
                                $carts = $order->cart;
                                foreach ($carts as $cart) {
                                    $total += $cart->price * $cart->quantity;
                                }
                                $discount = is_null($order->voucher_id) ? 0 : ($order->voucher->discount / 100) * $total;
                                $total -= $discount;
                            @endphp
                            <tr>
                                <td><a href="/admin/orders/edit/{{ $order->id }}">{{ $order->id }}</a></td>
                                <td>{{ $order->cus_name }}</td>
                                <td>{!! App\Helpers\Helper::status($order->status) !!}</td>
                                <td>
                                    {{ number_format($total, 0, ',', '.') }}<sup>đ</sup>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <a href="{{ route('order.list') }}" class="btn btn-sm btn-secondary float-right">Xem tất cả đơn hàng</a>
        </div>
    </div>
    <!-- PRODUCT LIST -->
    <div class="card col-md-6">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-barcode"></i> &ensp;Sản phẩm mới</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <ul class="products-list product-list-in-card pl-2 pr-2">
                @foreach ($products as $product)
                    <li class="item">
                        <div class="product-img">
                            <img src="{{ $product->thumb }}" alt="Product Image" class="img-size-50">
                        </div>
                        <div class="product-info">
                            <a href="/san-pham/{{ $product->id . '-' . Str::slug($product->name, '-') }}"
                                class="product-title">{{ $product->name }}
                                <span class="float-right">{!! App\Helpers\Helper::price($product->price, $product->price_sale) !!}</span></a>
                            <span class="product-description">
                                {{ $product->description }}
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- /.card-body -->
        <div class="card-footer text-center">
            <a href="{{ route('product.list') }}" class="uppercase">Xem tất cả sản phẩm</a>
        </div>
    </div>
@endsection
