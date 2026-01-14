@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa Danh mục</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT') <div class="form-group">
                    <label for="name">Tên danh mục</label>
                    <input type="text" class="form-control" id="name" name="name" 
                        value="{{ $category->name }}" 
                        placeholder="Ví dụ: Áo sơ mi nam...">
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>

</div>
@endsection