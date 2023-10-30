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
                        <label for="menu">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="menu" name="name" value="{{ old('name') }}"
                            placeholder="Nhập tên sản phẩm">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="menu">Loại sản phẩm</label>
                        <select class="form-control" name="menu_id">
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="menu">Giá gốc</label>
                        <input type="number" class="form-control" id="" name="price" value="{{ old('price') }}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="menu">Giá giảm</label>
                        <input type="number" class="form-control" id="" name="price_sale" value="{{ old('price_sale') }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="menu">Mô tả</label>
                <textarea name="description" class="form-control" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="menu">Chi tiết</label>
                <textarea id="content" name="content" class="form-control" placeholder="Nhập chi tiết">{{ old('content') }}</textarea>
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="active" value="1" checked name="active">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="unactive" value="0" name="active">
                    <label for="unactive" class="custom-control-label">Không</label>
                </div>
            </div>

            <div class="form-group">
                <label for="file">Chọn ảnh</label><br>
                <input type="file" id="upload">
                <div id="image_show">
                </div>
                <input type="hidden" name="thumb" id="thumb">
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo sản phẩm</button>
        </div>
        @csrf
    </form>
@endsection
@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
