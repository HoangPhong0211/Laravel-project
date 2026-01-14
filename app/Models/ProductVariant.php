<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <--- QUAN TRỌNG: Phải có dòng này!
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'size', 'color', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}