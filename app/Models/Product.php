<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Cho phép nhập liệu các cột này
    protected $fillable = [
        'name', 
        'image', 
        'price', 
        'quantity', 
        'description', 
        'category_id'
    ];

    // Thiết lập mối quan hệ: Sản phẩm thuộc về 1 Danh mục
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}