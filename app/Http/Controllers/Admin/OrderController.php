<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order; // <--- Nhớ dòng này

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // B1: Khởi tạo query
        $query = Order::query();

        // B2: Lọc dữ liệu (Tìm 1 trong 3 trường)
        if ($request->has('keyword') && $request->keyword != '') {
            $keyword = $request->keyword;
        
            $query->where(function ($q) use ($keyword) {
                $q->where('id', $keyword) // Tìm theo Mã ID chính xác
                ->orWhere('customer_name', 'LIKE', "%{$keyword}%") // Hoặc tìm theo Tên (gần đúng)
                ->orWhere('customer_phone', 'LIKE', "%{$keyword}%"); // Hoặc tìm theo SĐT
            });
        }

        // B3: Lấy dữ liệu (Mới nhất lên đầu)
        $orders = $query->latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    // Chúng ta sẽ làm hàm xem chi tiết (show) sau
    public function show($id)
    {
        // Lấy đơn hàng theo ID
        // with('details.product') nghĩa là: Lấy luôn cả chi tiết đơn hàng + thông tin sản phẩm bên trong
        $order = Order::with('details.product')->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        // 1. Tìm đơn hàng
        $order = Order::findOrFail($id);

        // 2. Cập nhật trạng thái mới
        $order->status = $request->status;
        $order->save();

        // 3. Quay lại trang chi tiết và báo thành công
        return redirect()->route('admin.orders.show', $id)->with('success', 'Cập nhật trạng thái thành công!');
    }
}