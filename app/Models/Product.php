<?php

namespace App\Models;

use App\Models\Category;
use App\Models\OrderDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $fillable = ['name', 'description', 'category_id', 'stock', 'price', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function order_detail(): HasMany
    {
        return $this->hasMany(OrderDetails::class, 'product_id');
    }
    public function review(): HasMany
    {
        return $this->hasMany(Review::class, 'product_id');
    }
    public function averageRating()
    {
        return $this->review()->avg('rating');
    }
}
