<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) // <--- Nhớ thêm Request $request
    {
        // BƯỚC 1: Khởi tạo "dự định" lấy dữ liệu (Chưa lấy ngay)
        // Thay vì paginate() ngay, ta chỉ gọi with() để đó
        $query = Product::with('category'); 

        // BƯỚC 2: Kiểm tra xem có cần tìm kiếm không?
        // Nếu có từ khóa -> Thêm điều kiện lọc vào "dự định" ở trên
        if ($request->has('keyword') && $request->keyword != '') {
            $query->where('name', 'LIKE', "%{$request->keyword}%");
        }

        // BƯỚC 3: Bây giờ mới chốt đơn và lấy dữ liệu
        $products = $query->latest()->paginate(10);

        // BƯỚC 4: Trả về giao diện
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Lấy danh sách danh mục để hiển thị ra menu chọn (Dropdown)
        $categories = Category::all();
    
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate dữ liệu (Có thêm check ảnh phải là file hình)
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Chỉ cho phép ảnh < 2MB
        ]);

        // 2. Xử lý Upload Ảnh (Phần khó nhất)
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
        
            // Tạo tên file ngẫu nhiên để không bị trùng (Ví dụ: 17042023_tenanh.jpg)
            $filename = time() . '_' . $file->getClientOriginalName();
        
            // Lưu ảnh vào thư mục 'public/uploads/products'
            $file->move(public_path('uploads/products'), $filename);
        
            // Lưu đường dẫn vào biến để cất vào Database
            $imagePath = 'uploads/products/' . $filename;
        }

        // 3. Lưu vào Database
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imagePath, // Cột này sẽ lưu đường dẫn ảnh (ví dụ: uploads/products/abc.jpg)
        ]);

        // 4. Quay về danh sách
        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all(); // Lấy danh mục để hiện dropdown
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'nullable|image|max:2048', // Ảnh không bắt buộc nhập lại
        ]);

        $product = Product::findOrFail($id);
        $data = $request->all(); // Lấy hết dữ liệu gửi lên

        // Xử lý nếu có up ảnh mới
        if ($request->hasFile('image')) {
            // 1. Xóa ảnh cũ đi
            if (File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }
        
            // 2. Up ảnh mới
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            $data['image'] = 'uploads/products/' . $filename;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Xóa ảnh cũ trong thư mục (nếu có) để đỡ rác máy
        if (File::exists(public_path($product->image))) {
            File::delete(public_path($product->image));
        }

        // Xóa dữ liệu trong Database
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Đã xóa sản phẩm!');
    }
}
