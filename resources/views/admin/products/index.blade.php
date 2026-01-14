@extends('admin.layout')

@section('content')
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách Sản phẩm</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Thêm mới
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Giá bán</th>
                            <th>Tồn kho</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td width="100">
                                    @if($item->image)
                                        <img src="{{ asset($item->image) }}" width="80" height="80" style="object-fit: cover; border-radius: 5px;">
                                    @else
                                        <span class="text-muted small">No Image</span>
                                    @endif
                                </td>
                                
                                <td>{{ $item->name }}</td>
                                
                                <td>
                                    <span class="badge badge-info">{{ $item->category->name ?? 'Không có' }}</span>
                                </td>

                                <td class="text-danger font-weight-bold">{{ number_format($item->price) }} đ</td>
                                <td>{{ $item->quantity }}</td>
                                
                                <td>
                                    <a href="{{ route('admin.products.edit', $item->id) }}" class="btn btn-warning btn-sm">Sửa</a>

                                    <a href="{{ route('admin.products.variants.index', $item->id) }}" class="btn btn-primary btn-sm">
                                        Biến thể
                                    </a>
                                    
                                    <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn chắc chắn muốn xóa?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                {{ $products->links() }}
            </div>
        </div>
    </div>

</div>
@endsection