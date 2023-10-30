@extends('admin.users.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Thêm khuyễn mãi</h3>
                    </div>
                </div>
                <form action="" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="menu">Tên khuyến mãi</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                placeholder="Nhập tên khuyến mãi" required>
                        </div>
                        <div class="form-group">
                            <label for="menu">Giảm giá (%)</label>
                            <input type="number" class="form-control" name="discount" value="{{ old('discount') }}"
                                placeholder="Nhập % giảm giá" required>
                        </div>
                        <div class="form-group">
                            <label for="menu">Nội dung</label>
                            <input type="text" class="form-control" name="content" value="{{ old('content') }}"
                                placeholder="Nhập nội dung" required>
                        </div>
                        <div class="form-group">
                            <label>Kích hoạt</label>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="active" value="1" checked
                                    name="active">
                                <label for="active" class="custom-control-label">Có</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="unactive" value="0" name="active">
                                <label for="unactive" class="custom-control-label">Không</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Tạo khuyến mãi</button>
                    </div>
                    @csrf
                </form>
            </div>
            <div class="col-md-8">
                <div class="card card-primary mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách khuyến mãi</h3>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mã khuyến mãi</th>
                            <th>Tên khuyến mãi</th>
                            <th>Nội dung</th>
                            <th>Giảm (%)</th>
                            <th>Trạng thái</th>
                            <th>Lựa chọn</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($vouchers as $voucher)
                            <tr>
                                <td>{{ $voucher->id }}</td>
                                <td>{{ $voucher->name }}</td>
                                <td>{{ $voucher->content }}</td>
                                <td>{{ $voucher->discount }}</td>
                                <td>{{ $voucher->active }}</td>
                                <td><a class="btn btn-primary btn-sm" href='/admin/vouchers/edit/{{ $voucher->id }}'>
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm"
                                        onclick="removeRow('{{ $voucher->id }}', '/admin/vouchers/destroy')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div><!-- /.container-fluid -->
@endsection
