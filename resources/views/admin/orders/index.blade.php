@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý Đơn hàng</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Tên khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày đặt</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                            <tr>
                                <td>#{{ $item->id }}</td>
                                <td>
                                    <strong>{{ $item->customer_name }}</strong><br>
                                    <small>{{ $item->customer_phone }}</small>
                                </td>
                                <td class="text-danger font-weight-bold">{{ number_format($item->total_price) }} đ</td>
                                <td>
                                    @if($item->status == 0)
                                        <span class="badge badge-warning">Chờ duyệt</span>
                                    @elseif($item->status == 1)
                                        <span class="badge badge-info">Đang giao</span>
                                    @elseif($item->status == 2)
                                        <span class="badge badge-success">Đã giao</span>
                                    @else
                                        <span class="badge badge-danger">Đã hủy</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $item->id) }}" class="btn btn-info btn-sm">Xem chi tiết</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                {{ $orders->appends(request()->all())->links() }}
            </div>
        </div>
    </div>

</div>
@endsection