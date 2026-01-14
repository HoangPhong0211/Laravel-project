@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Biến thể: {{ $product->name }}</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left"></i> Quay lại sản phẩm
        </a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thêm biến thể mới</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.variants.store', $product->id) }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label>Kích cỡ (Size)</label>
                            <input type="text" name="size" class="form-control" placeholder="VD: S, M, 39..." required>
                        </div>

                        <div class="form-group">
                            <label>Màu sắc</label>
                            <input type="text" name="color" class="form-control" placeholder="VD: Đỏ, Xanh..." required>
                        </div>

                        <div class="form-group">
                            <label>Số lượng</label>
                            <input type="number" name="quantity" class="form-control" value="0" min="0" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Thêm ngay</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách các phiên bản</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Size</th>
                                <th>Màu</th>
                                <th>Số lượng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product->variants as $variant)
                                <tr>
                                    <td>{{ $variant->size }}</td>
                                    <td>
                                        <span class="badge badge-secondary">{{ $variant->color }}</span>
                                    </td>
                                    <td>{{ $variant->quantity }}</td>
                                    <td>
                                        <a href="{{ route('admin.products.variants.edit', $variant->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                        
                                        <form action="{{ route('admin.products.variants.destroy', $variant->id) }}" method="POST" 
                                              onsubmit="return confirm('Xóa biến thể này?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if($product->variants->count() == 0)
                                <tr><td colspan="4" class="text-center">Chưa có biến thể nào</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection