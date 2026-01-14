@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sửa Sản phẩm: {{ $product->name }}</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                        </div>

                        <div class="form-group">
                            <label>Mô tả chi tiết</label>
                            <textarea name="description" class="form-control" rows="5">{{ $product->description }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Giá bán (VNĐ)</label>
                            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                        </div>

                        <div class="form-group">
                            <label>Số lượng</label>
                            <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}">
                        </div>

                        <div class="form-group">
                            <label>Ảnh sản phẩm</label>
                            <input type="file" name="image" class="form-control-file mb-2">
                            
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" width="100" style="border-radius: 5px; border: 1px solid #ddd;">
                            @endif
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
            </form>
        </div>
    </div>

</div>
@endsection