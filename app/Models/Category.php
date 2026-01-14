<?php

namespace App\Models; // 1. Định danh: Tôi thuộc dòng họ App\Models

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // 2. Khai báo: Model lấy từ thư viện của Laravel

class Category extends Model
{
    use HasFactory;

    // Cho phép nhập liệu vào cột 'name'
    protected $fillable = ['name'];
}
?>