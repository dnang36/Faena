@extends('admin.charts.chart')
@section('chart')
    <div id="quantityChart" style="height: 250px;"></div>
    @php
    $sumQuantity = 0;
    @endphp
    <script type="text/javascript">
        @if (count($datas) > 0)
        
            @if (request()->input('type') == 'pie-chart')
                new Morris.Donut({
                element: 'quantityChart',
                data: [
                @foreach ($datas as $cart)
                    @php
                        $sumQuantity += $cart->sumQuantity;
                    @endphp
                    {
                    label: '{{ $cart->name }}',
                    value: {{ $cart->sumQuantity }}
                    },
                @endforeach
                ]
                });
            @else
                new Morris.Bar({
                element: 'quantityChart',
                data: [
                @foreach ($datas as $cart)
                    @php
                        $sumQuantity += $cart->sumQuantity;
                    @endphp
                    {
                    y: '{{ $cart->name }}',
                    a: {{ $cart->sumQuantity }}
                    },
                @endforeach
                ],
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Số lượng']
                });
            @endif
        @endif
    </script>
    <div><strong>TỔNG SỐ SẢN PHẨM ĐÃ BÁN: </strong>{{ $sumQuantity }}<br>
        <strong>SẢN PHẨM BÁN CHẠY NHẤT: </strong>
        @if (count($datas) > 0)
            @php
                $max = 0;
                foreach ($datas as $product) {
                    if ($max < $product->sumQuantity) {
                        $max = $product->sumQuantity;
                    }
                }
            @endphp
            @foreach ($datas as $product)
                @if ($max == $product->sumQuantity)
                    <a
                        href="/san-pham/{{ $product->id . '-' . Str::slug($product->name, '-') }}">{{ $product->name }}</a>,
                @endif
            @endforeach
        @endif
    </div>
@endsection
