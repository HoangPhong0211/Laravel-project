@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sửa Biến thể</h1>
    </div>

    <div class="card shadow mb-4" style="max-width: 600px; margin: 0 auto;">
        <div class="card-body">
            <form action="{{ route('admin.products.variants.update', $variant->id) }}" method="POST">
                @csrf
                @method('PUT') <div class="form-group">
                    <label>Kích cỡ (Size)</label>
                    <input type="text" name="size" class="form-control" value="{{ $variant->size }}" required>
                </div>

                <div class="form-group">
                    <label>Màu sắc</label>
                    <input type="text" name="color" class="form-control" value="{{ $variant->color }}" required>
                </div>

                <div class="form-group">
                    <label>Số lượng</label>
                    <input type="number" name="quantity" class="form-control" value="{{ $variant->quantity }}" min="0" required>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    <a href="{{ route('admin.products.variants.index', $variant->product_id) }}" class="btn btn-secondary">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection