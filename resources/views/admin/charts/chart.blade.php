@extends('admin.users.main')
@section('head')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="/template/admin/css/chart.css" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
@endsection
@section('content')

    <body>
        <div><strong>BIỂU ĐỒ:</strong>&ensp;<a class="type-chart"
                href="{{ request()->fullUrlWithQuery(['type' => 'bar-chart']) }}">Cột</a>&ensp;<a class="type-chart"
                href="{{ request()->fullUrlWithQuery(['type' => 'pie-chart']) }}">Tròn</a>
        </div><br>
        <form method="POST" action="">
            <div><strong>Từ: </strong>&ensp;<input value="{{ Session::has('from') ? Session::get('from') : '' }}"
                    name="from-date" type="date" />&ensp;<strong>Đến:
                </strong>&ensp;<input value="{{ Session::has('to') ? Session::get('to') : '' }}" name="to-date"
                    type="date" />&ensp;&ensp;
                <input type="submit" value="OK">
            </div>
            @csrf
        </form>
        @yield('chart')
    </body>
@endsection
