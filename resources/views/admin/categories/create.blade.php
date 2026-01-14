@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm Danh mục mới</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf <div class="form-group">
                    <label for="name">Tên danh mục</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Ví dụ: Áo sơ mi nam...">
                </div>

                <button type="submit" class="btn btn-primary">Lưu lại</button>
            </form>
        </div>
    </div>

</div>
@endsection