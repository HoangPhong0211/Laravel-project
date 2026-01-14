<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; 

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // B1: Khởi tạo query
        $query = Category::query();

        // B2: Lọc theo tên danh mục
        if ($request->has('keyword') && $request->keyword != '') {
            $query->where('name', 'LIKE', "%{$request->keyword}%");
        }   

        // B3: Lấy dữ liệu
        $categories = $query->latest()->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate dữ liệu
        $request->validate([
            'name' => 'required|min:3|max:255'
        ]);

        // 2. Lưu vào Database (Chú ý: Dùng 2 dấu :: )
        Category::create([
            'name' => $request->name
        ]);

        // 3. Quay về trang danh sách (Nếu chưa có trang index thì nó sẽ báo lỗi tiếp, nhưng kệ nó, quan trọng là lưu được)
        return redirect()->route('admin.categories.index')->with('success', 'Thêm danh mục thành công!');
    }

    // Các hàm show, edit, update, destroy tạm thời để nguyên mặc định của Laravel
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id); // Tìm danh mục, không thấy thì báo lỗi 404
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        // Validate
        $request->validate([
            'name' => 'required|min:3|max:255'
        ]);

        // Tìm và update
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(string $id)
    {
        // 1. Tìm danh mục theo ID
        $category = Category::findOrFail($id);

        // 2. Xóa nó đi
        $category->delete();

        // 3. Quay về danh sách và báo công
        return redirect()->route('admin.categories.index')->with('success', 'Đã xóa danh mục thành công!');
    }
}