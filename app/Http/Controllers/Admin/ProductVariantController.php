<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductVariantController extends Controller
{
    // 1. Xem danh sách biến thể của sản phẩm $id
    public function index($product_id)
    {
        $product = Product::with('variants')->findOrFail($product_id);
        return view('admin.products.variants', compact('product'));
    }

    // 2. Lưu biến thể mới
    public function store(Request $request, $product_id)
    {
        $request->validate([
            'size' => 'required',
            'color' => 'required',
            'quantity' => 'required|numeric|min:0'
        ]);

        ProductVariant::create([
            'product_id' => $product_id,
            'size' => $request->size,
            'color' => $request->color,
            'quantity' => $request->quantity
        ]);

        return redirect()->back()->with('success', 'Đã thêm biến thể thành công!');
    }

    // 3. Xóa biến thể
    public function destroy($variant_id)
    {
        ProductVariant::destroy($variant_id);
        return redirect()->back()->with('success', 'Đã xóa biến thể!');
    }

    // Hàm 4: Hiển thị form sửa
    public function edit($variant_id)
    {
        $variant = ProductVariant::findOrFail($variant_id);
        return view('admin.products.edit_variant', compact('variant')); 
    }

    // Hàm 5: Lưu dữ liệu sau khi sửa
    public function update(Request $request, $variant_id)
    {
        $request->validate([
            'size' => 'required',
            'color' => 'required',
            'quantity' => 'required|numeric|min:0'
        ]);

        $variant = ProductVariant::findOrFail($variant_id);
    
        $variant->update([
            'size' => $request->size,
            'color' => $request->color,
            'quantity' => $request->quantity
        ]);

        // Sửa xong thì quay về trang danh sách biến thể của sản phẩm cha
        return redirect()->route('admin.products.variants.index', $variant->product_id)
                        ->with('success', 'Cập nhật biến thể thành công!');
    }
}