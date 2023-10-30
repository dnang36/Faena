<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link type="text/css" rel="stylesheet" href="/template/admin/css/chitietdonhang.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>

<body>
    <div class="">
        <h3>Xin chào {{ $user->name }} </h3>
        <h3>Mật khẩu mới của bạn là </h3>
        <b>{{ $new_pass }}</b>
    </div>
</body>

</html>
