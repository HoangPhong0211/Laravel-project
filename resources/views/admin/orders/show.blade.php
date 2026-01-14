@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chi tiết đơn hàng #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông tin khách hàng</h6>
                </div>
                <div class="card-body">
                    <p><strong>Họ tên:</strong> {{ $order->customer_name }}</p>
                    <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                    <p><strong>SĐT:</strong> {{ $order->customer_phone }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
                    <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->details as $detail)
                                <tr>
                                    <td>
                                        {{ $detail->product->name ?? 'Sản phẩm đã bị xóa' }}
                                        <br>
                                        @if(isset($detail->product->image))
                                            <img src="{{ asset($detail->product->image) }}" width="50">
                                        @endif
                                    </td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ number_format($detail->price) }} đ</td>
                                    <td>{{ number_format($detail->quantity * $detail->price) }} đ</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="text-right font-weight-bold">Tổng cộng:</td>
                                <td class="text-danger font-weight-bold">{{ number_format($order->total_price) }} đ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Trạng thái đơn hàng</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Trạng thái hiện tại:</label>
                            <select name="status" class="form-control">
                                <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Chờ duyệt</option>
                                <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Đang giao hàng</option>
                                <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Đã hoàn thành</option>
                                <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Cập nhật trạng thái</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection