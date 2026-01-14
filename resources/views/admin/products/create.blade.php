@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm Sản phẩm mới</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Mô tả chi tiết</label>
                            <textarea name="description" class="form-control" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Giá bán (VNĐ)</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Số lượng tồn kho</label>
                            <input type="number" name="quantity" class="form-control" value="0">
                        </div>

                        <div class="form-group">
                            <label>Ảnh sản phẩm</label>
                            <input type="file" name="image" class="form-control-file">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Lưu sản phẩm</button>
            </form>
        </div>
    </div>

</div>
@endsection