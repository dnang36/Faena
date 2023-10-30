@extends('admin.users.main')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
<form action="" method="POST">
    <div class="card-body">
        <div class="form-group">
            <label for="menu">Tên danh mục</label>
            <input type="hidden" class="form-control" id="menu" name="id" value="{{$menu->id}}">
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục"
                value="{{$menu->name}}">
        </div>

        <div class="form-group">
            <label for="menu">Danh mục</label>
            <select class="form-control" name="parent_id">
                @foreach($menus as $menuParent)
                <option value="{{$menuParent->id}}" {{$menu->parent_id == $menuParent->id ? 'selected':''}}>
                    {{$menuParent->name}}
                </option>
                @endforeach
                <option value="0" {{$menu->parent_id == 0 ? 'selected':''}}>Danh mục cha</option>
            </select>
        </div>

        <div class="form-group">
            <label for="menu">Mô tả</label>
            <textarea name="description" class="form-control" placeholder="Nhập mô tả">{{$menu->description}}</textarea>
        </div>

        <div class="form-group">
            <label for="menu">Chi tiết</label>
            <textarea id="content" name="content" class="form-control"
                placeholder="Nhập chi tiết">{{$menu->content}}</textarea>
        </div>

        <div class="form-group">
            <label>Kích hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="active" value="1"
                    {{$menu->active == 1 ? 'checked':''}} name="active">
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="unactive" value="0"
                    {{$menu->active == 1 ? '':'checked'}} name="active">
                <label for="unactive" class="custom-control-label">Không</label>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Sửa danh mục</button>
    </div>
    @csrf
</form>
@endsection
@section('footer')
<script>
CKEDITOR.replace('content');
</script>
@endsection