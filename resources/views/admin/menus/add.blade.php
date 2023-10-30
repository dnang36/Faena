@extends('admin.users.main')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
<form action="" method="POST">
    <div class="card-body">
        <div class="form-group">
            <label for="menu">Tên danh mục</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục">
        </div>

        <div class="form-group">
            <label for="menu">Danh mục</label>
            <select class="form-control" name="parent_id">
                @foreach($menus as $menu)
                <option value="{{$menu->id}}">{{$menu->name}}</option>
                @endforeach
                <option value="0">Danh mục cha</option>
            </select>
        </div>

        <div class="form-group">
            <label for="menu">Mô tả</label>
            <textarea name="description" class="form-control" placeholder="Nhập mô tả"></textarea>
        </div>

        <div class="form-group">
            <label for="menu">Chi tiết</label>
            <textarea id="content" name="content" class="form-control" placeholder="Nhập chi tiết"></textarea>
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
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Tạo danh mục</button>
    </div>
    @csrf
</form>
@endsection
@section('footer')
<script>
CKEDITOR.replace('content');
</script>
@endsection