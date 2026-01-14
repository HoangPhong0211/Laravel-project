<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Các con số thống kê cơ bản
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalRevenue = Order::where('status', 2)->sum('total_price'); // Chỉ tính đơn đã hoàn thành (status = 2)
        $pendingOrders = Order::where('status', 0)->count(); // Đơn chờ duyệt

        // 2. Dữ liệu biểu đồ Doanh thu 12 tháng (Area Chart)
        $monthlyRevenue = Order::select(
            DB::raw('SUM(total_price) as sum'), 
            DB::raw('MONTH(created_at) as month')
        )
        ->where('status', 2) // Chỉ tính đơn thành công
        ->whereYear('created_at', date('Y')) // Lấy năm nay
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('sum', 'month');

        // Chuẩn bị mảng 12 tháng (Tháng nào không có doanh thu thì điền 0)
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $monthlyRevenue[$i] ?? 0;
        }

        // 3. Dữ liệu biểu đồ Trạng thái đơn hàng (Pie Chart)
        $statusCounts = Order::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')->all();
        
        // Mảng thứ tự: [Chờ duyệt, Đang giao, Hoàn thành, Hủy]
        $pieData = [
            $statusCounts[0] ?? 0,
            $statusCounts[1] ?? 0,
            $statusCounts[2] ?? 0,
            $statusCounts[3] ?? 0,
        ];

        return view('admin.dashboard', compact(
            'totalOrders', 'totalProducts', 'totalRevenue', 'pendingOrders', 
            'chartData', 'pieData'
        ));
    }
}