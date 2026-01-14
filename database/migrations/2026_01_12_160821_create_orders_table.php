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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');    // Tên khách hàng
            $table->string('customer_email');   // Email
            $table->string('customer_phone');   // Số điện thoại
            $table->string('customer_address'); // Địa chỉ giao hàng
        
            $table->decimal('total_price', 15, 2); // Tổng tiền đơn hàng
        
            // Trạng thái đơn hàng (0: Chờ duyệt, 1: Đang giao, 2: Đã xong, 3: Đã hủy)
            $table->integer('status')->default(0); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
