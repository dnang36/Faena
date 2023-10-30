@extends('admin.users.main')
@section('content')
    <div class="container-fluid">
        <form action="" method="POST">
            <div class="card-body col-8">
                <div class="form-group">
                    <label for="menu">Tên khuyến mãi</label>
                    <input type="text" class="form-control" name="name" value="{{ $voucher->name }}"
                        placeholder="Nhập tên khuyến mãi" required>
                </div>
                <div class="form-group">
                    <label for="menu">Giảm giá (%)</label>
                    <input type="number" class="form-control" name="discount" value="{{ $voucher->discount }}"
                        placeholder="Nhập % giảm giá" required>
                </div>
                <div class="form-group">
                    <label for="menu">Nội dung</label>
                    <input type="text" class="form-control" name="content" value="{{ $voucher->content }}"
                        placeholder="Nhập nội dung" required>
                </div>
                <div class="form-group">
                    <label>Kích hoạt</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="active" value="1"
                            {{ $voucher->active == 1 ? 'checked' : '' }} name="active">
                        <label for="active" class="custom-control-label">Có</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="unactive" value="0"
                            {{ $voucher->active == 0 ? 'checked' : '' }} name="active">
                        <label for="unactive" class="custom-control-label">Không</label>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
            @csrf
        </form>
    </div><!-- /.container-fluid -->
@endsection
