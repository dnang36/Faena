@extends('admin.users.main')
@section('content')
    <div>
        <a class="filter" href="{{ request()->fullUrlWithQuery(['status' => '0']) }}"><i class="fas fa-spinner"></i>
            Đang chờ</a>&ensp;
        <a class="filter" href="{{ request()->fullUrlWithQuery(['status' => '1']) }}"><i class="fas fa-bus"></i>
            Đang giao</a>&ensp;
        <a class="filter" href="{{ request()->fullUrlWithQuery(['status' => '2']) }}"><i
                class="fas fa-check-circle"></i> Đã giao</a>&ensp;
        <a class="filter" href="{{ request()->fullUrlWithQuery(['status' => '3']) }}"><i
                class="far fa-window-close"></i> Đã hủy</a>&ensp;
        <a class="filter" href="{{ route('order.list') }}"><i class="fas fa-undo-alt"></i> Tất cả</a>&ensp;
    </div>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Tên khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Lựa chọn</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    @php
                        $total = 0;
                        $carts = $order->cart;
                        foreach ($carts as $cart) {
                            $total += $cart->price * $cart->quantity;
                        }
                        if (!is_null($order->voucher_id)) {
                            if (!is_null($order->voucher->id)) {
                                $discount = ($order->voucher->discount / 100) * $total;
                                $total -= $discount;
                            }
                        }
                    @endphp
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->cus_name }}</td>
                    <td>{{ number_format($total, 0, ',', '.') }}<sup>đ</sup>
                    </td>
                    <td>{!! App\Helpers\Helper::status($order->status) !!}</td>
                    <td><a class="btn btn-primary btn-sm" href='/admin/orders/edit/{{ $order->id }}'>
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm"
                            onclick="removeRow('{{ $order->id }}', '/admin/orders/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (count($orders) > 0)
        {{ $orders->links() }}
    @endif
@endsection
