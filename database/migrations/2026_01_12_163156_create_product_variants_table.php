<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();

            // Liên kết với sản phẩm cha
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->string('size')->nullable();  // Ví dụ: S, M, L, XL, 39, 40...
            $table->string('color')->nullable(); // Ví dụ: Đỏ, Xanh, Red, Blue...
            $table->integer('quantity')->default(0); // Số lượng riêng của biến thể này

            // (Nâng cao: Có thể thêm giá riêng cho biến thể nếu muốn, nhưng tạm thời bỏ qua cho đơn giản)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
