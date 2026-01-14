<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    // Món này thuộc về đơn hàng nào?
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Món này là sản phẩm gì? (Để lấy tên và ảnh sản phẩm)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

?>