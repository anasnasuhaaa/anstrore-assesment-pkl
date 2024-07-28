<?php

namespace App\Models;

use App\Models\Category;
use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $fillable = ['name', 'description', 'category_id', 'stock', 'price', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function order_detail(): HasOne
    {
        return $this->hasOne(OrderDetail::class, 'product_id');
    }
}
