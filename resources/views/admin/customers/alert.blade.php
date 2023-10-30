@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- thông báo lỗi dùng FacadesSession -->
@if (Session::has('error'))
    <div style="font-size:12px" class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif

@if (Session::has('success'))
    <div style="font-size:12px" class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif
