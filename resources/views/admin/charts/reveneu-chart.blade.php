@extends('admin.charts.chart')
@section('chart')

    <div id="reveneuChart" style="height: 250px;"></div>
    <script type="text/javascript">
        @php
        $sumReveneu = 0;
        @endphp
        @if (count($datas) > 0)
        
            @if (request()->input('type') == 'pie-chart')
                new Morris.Donut({
                element: 'reveneuChart',
                data: [
                @foreach ($datas as $cart)
                    @php
                        $sumReveneu += $cart->total;
                    @endphp
                    {
                    label: 'Tháng {{ $cart->month }}',
                    value: {{ $cart->total }}
                    },
                @endforeach
                ]
                });
            @else
                new Morris.Bar({
                element: 'reveneuChart',
                data: [
                @foreach ($datas as $cart)
                    @php
                        $sumReveneu += $cart->total;
                    @endphp
                    {
                    y: 'Tháng {{ $cart->month }}',
                    a: {{ $cart->total }}
                    },
                @endforeach
                ],
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Số tiền (đ)']
                });
            @endif
        @endif
    </script>
    <div><strong>TỔNG DOANH THU: </strong>{{ number_format($sumReveneu, 0, ',', '.') }}đ<br>
        <strong>THÁNG CÓ DOANH THU CAO NHẤT: </strong>
        @if (count($datas) > 0)
            @php
                $max = 0;
                foreach ($datas as $month) {
                    if ($max < $month->total) {
                        $max = $month->total;
                    }
                }
            @endphp
            @foreach ($datas as $month)
                @if ($max == $month->total)
                    {{ $month->month }}
                @endif
            @endforeach
        @endif
    </div>
@endsection
