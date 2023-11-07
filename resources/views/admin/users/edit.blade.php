@extends('admin.users.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="menu">Tên tài khoản</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" readonly>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="menu">Email</label>
                        <input type="email" class="form-control" id="" name="email" value="{{ $user->email }}"
                            placeholder="Nhập email">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="menu">Mật khẩu</label>
                        <input type="password" class="form-control" id="name" name="password"
                            value="{{ old('password') }}" placeholder="Nhập mật khẩu">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="menu">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" id="" name="repassword"
                            value="{{ old('repassword') }}" placeholder="Nhập lại mật khẩu">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label>Phân quyền</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="active" value="1"
                            {{ $user->roles == 1 ? 'checked' : '' }} name="roles">
                        <label for="active" class="custom-control-label">Quản trị</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="unactive" value="0"
                            {{ $user->roles == 0 ? 'checked' : '' }} name="roles">
                        <label for="unactive" class="custom-control-label">Người dùng</label>
                    </div>
{{--                    <div class="custom-control custom-radio">--}}
{{--                        <input class="custom-control-input" type="radio" id="checknv" value="2"--}}
{{--                               {{ $user->roles == 2 ? 'checked' : '' }} name="roles">--}}
{{--                        <label for="checknv" class="custom-control-label">Nhân viên</label>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Sửa</button>
        </div>
        <input type="hidden" value="{{ $user->id }}">
        @csrf
    </form>
@endsection
