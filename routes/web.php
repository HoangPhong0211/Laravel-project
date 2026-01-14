<?php
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Đường dẫn quản lý danh mục (tự động tạo ra các link thêm/sửa/xóa)
    Route::resource('categories', CategoryController::class);

    // Products (Sản phẩm)
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

    // Quản lý Đơn hàng
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);

    // Quản lý Biến thể (Variants)
    Route::get('products/{id}/variants', [\App\Http\Controllers\Admin\ProductVariantController::class, 'index'])->name('products.variants.index');
    Route::post('products/{id}/variants', [\App\Http\Controllers\Admin\ProductVariantController::class, 'store'])->name('products.variants.store');
    Route::delete('products/variants/{variant_id}', [\App\Http\Controllers\Admin\ProductVariantController::class, 'destroy'])->name('products.variants.destroy');

    Route::get('products/variants/{variant_id}/edit', [\App\Http\Controllers\Admin\ProductVariantController::class, 'edit'])->name('products.variants.edit');
    Route::put('products/variants/{variant_id}', [\App\Http\Controllers\Admin\ProductVariantController::class, 'update'])->name('products.variants.update');

    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
});

?>
