<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tạo Danh mục (Lưu ID lại để dùng)
        $cats = [
            'Áo sơ mi nam' => Category::create(['name' => 'Áo sơ mi nam'])->id,
            'Quần Jeans' => Category::create(['name' => 'Quần Jeans'])->id,
            'Váy đầm nữ' => Category::create(['name' => 'Váy đầm nữ'])->id,
            'Áo khoác' => Category::create(['name' => 'Áo khoác mùa đông'])->id,
            'Giày' => Category::create(['name' => 'Giày Sneaker'])->id,
        ];

        // 2. Danh sách tên sản phẩm thật (Theo từng loại)
        $productsMap = [
            $cats['Áo sơ mi nam'] => ['Sơ mi Oxford Trắng', 'Sơ mi Kẻ sọc xanh', 'Sơ mi Flannel Caro', 'Sơ mi Cổ tàu'],
            $cats['Quần Jeans'] => ['Quần Jeans Slimfit', 'Quần Baggy Rách gối', 'Quần Short Jeans', 'Quần Jeans Ống rộng'],
            $cats['Váy đầm nữ'] => ['Váy hoa nhí Vintage', 'Đầm dự tiệc đen', 'Chân váy xếp ly', 'Đầm maxi đi biển'],
            $cats['Áo khoác'] => ['Áo phao lông vũ', 'Áo Blazer Hàn Quốc', 'Áo khoác da Biker', 'Áo Cardigan Len'],
            $cats['Giày'] => ['Giày Sneaker Trắng', 'Giày Chạy bộ Ultra', 'Giày Vải Canvas', 'Giày Chunky Hầm hố'],
        ];

        // 3. Tạo Sản phẩm từ danh sách trên
        foreach ($productsMap as $catId => $names) {
            foreach ($names as $name) {
                Product::create([
                    'name' => $name, // Tên thật
                    'price' => rand(200000, 2000000), // Giá ngẫu nhiên
                    'quantity' => rand(10, 100),
                    'description' => 'Chất liệu cao cấp, thoáng mát, phù hợp mọi hoàn cảnh.',
                    'category_id' => $catId,
                    'image' => null 
                ]);
            }
        }

        // 4. Tạo Đơn hàng mẫu (Giữ nguyên logic cũ để vẽ biểu đồ)
        for ($i = 1; $i <= 50; $i++) {
            $year = date('Y'); // Lấy năm hiện tại
            $month = rand(1, 12); // Tháng ngẫu nhiên 1-12
            $day = rand(1, 28); // Ngày ngẫu nhiên 1-28 (để tránh lỗi tháng 2)

            $date = \Carbon\Carbon::create($year, $month, $day, rand(8, 20), rand(0, 59), rand(0, 59));
            
            $order = Order::create([
                'customer_name' => 'Khách hàng ' . $i,
                'customer_email' => 'khach'.$i.'@gmail.com',
                'customer_phone' => '0912345678',
                'customer_address' => 'Hà Nội',
                'total_price' => 0, 
                'status' => rand(0, 3), 
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            // Random sản phẩm cho đơn hàng
            $total = 0;
            for ($j = 1; $j <= rand(1, 3); $j++) {
                $randomProduct = Product::inRandomOrder()->first(); // Lấy ngẫu nhiên 1 sản phẩm
                $qty = rand(1, 2);
                
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $randomProduct->id,
                    'quantity' => $qty,
                    'price' => $randomProduct->price
                ]);
                $total += $qty * $randomProduct->price;
            }
            $order->update(['total_price' => $total]);
        }
    }
}