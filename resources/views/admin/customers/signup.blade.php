<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="/template/admin/css/signup.css" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
</head>

<body>
    <form method="POST" action="/admin/users/signup/store">
        <div class="block-signup">
            <div class="caption">
                <p>{{ $title }}</p>
            </div>
            <div class="block-user">
                <div class="text-1">Tài khoản</div>
                <div class="user">
                    <i class="fas fa-user-circle"></i><input type="text" placeholder="Nhập tài khoản" name="name"
                        required value="{{ old('name') }}">
                </div>
                <br>
                <div class="text-1">Email</div>
                <div class="user">
                    <i class="fas fa-envelope-square"></i><input type="email" placeholder="Nhập email" name="email"
                        required value="{{ old('email') }}">
                </div>
                <br>
                <div class="text-1">Mật khẩu</div>
                <div class="user">
                    <i class="fas fa-lock"></i><input type="password" placeholder="Nhập mật khẩu" name="password"
                        required value="{{ old('password') }}">
                </div>
                <br>
                <div class="text-1">Xác nhận mật khẩu</div>
                <div class="user">
                    <i class="fas fa-lock"></i></i><input type="password" placeholder="Nhập lại mật khẩu"
                        name="repassword" required value="{{ old('repassword') }}">
                </div>
            </div>
            <br>
            <div class="btn-signup">
                <button class="signup" type="submit">
                    Đăng ký
                </button>
                <br>
                <br>
                <a href="{{ route('login') }}">Đã có tài khoản?</a>
            </div><br>
            <div class="hr-decor">
                <hr>
                <i class="far fa-circle"></i>
                <i class="far fa-circle"></i>
                <i class="far fa-circle"></i>
                <hr>
            </div>
        </div>

        @csrf
    </form>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
</body>

</html>
