<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="/template/admin/css/login.css" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
</head>

<body>
    <form method="POST" action="/admin/users/login/store">
        <div class="block-login">
            <div class="caption">
                <p>ĐĂNG NHẬP</p>
            </div>
            <div class="block-user">
                <div class="text-1">Tài khoản</div>
                <div class="user">
                    <i class="fas fa-user-circle"></i><input type="text" placeholder="Nhập tài khoản" name="name"
                        required>
                </div>
                <br>
                <div class="text-1">Mật khẩu</div>
                <div class="user">
                    <i class="fas fa-lock"></i><input type="password" placeholder="Nhập mật khẩu" name="password"
                        required>
                </div>
            </div>
            <div class="block-forgot-pass">
                <a href="{{ route('forgot-pass') }}">Quên mật khẩu?</a>
            </div>
            <div class="btn-login">
                <button class="login" name="login">
                    Đăng nhập
                </button>
            </div>
            <br>
            <div class="block-signup">
                Chưa có tài khoản?<a href="{{ route('signup') }}">
                    Đăng ký
                </a>
            </div>
            <br>
{{--            <div class="block-link">--}}
{{--                <div class="text-link">--}}
{{--                    Bạn có thể đăng nhập bằng:--}}
{{--                </div>--}}
{{--                <div class="icon-link">--}}
{{--                    <a href="#"><img src="\template\admin\images\iconfb.jpg"></a>&emsp;--}}
{{--                    <a href="#"><img src="\template\admin\images\iconzalo.png"></a>&emsp;--}}
{{--                    <a href="#"><img src="\template\admin\images\iconig.png"></a>--}}
{{--                </div>--}}
{{--                <div class="hr-decor">--}}
{{--                    <hr>--}}
{{--                    <i class="far fa-circle"></i>--}}
{{--                    <i class="far fa-circle"></i>--}}
{{--                    <i class="far fa-circle"></i>--}}
{{--                    <hr>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        @csrf
    </form>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
</body>

</html>
