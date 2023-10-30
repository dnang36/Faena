@extends('admin.users.main')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
<form action="" method="POST">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label for="menu">Tên slide</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$slide->name}}"
                        placeholder="Nhập tên sản phẩm">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="menu">Link dẫn</label>
                    <input type="text" class="form-control" id="" name="url" value="{{$slide->url}}"
                        placeholder="Nhập tên sản phẩm">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label for="file">Chọn ảnh</label><br>
                    <input type="file" id="upload">
                    <div id="image_show">
                        <img src="{{$slide->thumb}}" width="200px" height="100px" />
                    </div>
                    <input type="hidden" name="thumb" id="thumb">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="menu">Sắp xếp</label>
                    <input type="number" class="form-control" id="" name="sort_by" value="{{$slide->sort_by}}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Kích hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="active" value="1"
                    {{$slide->active == 1 ? 'checked':''}} name="active">
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="unactive" value="0"
                    {{$slide->active == 0 ? 'checked':''}} name="active">
                <label for="unactive" class="custom-control-label">Không</label>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Sửa slide</button>
    </div>
    @csrf
</form>
@endsection
@section('footer')
<script>
CKEDITOR.replace('content');
</script>
@endsection