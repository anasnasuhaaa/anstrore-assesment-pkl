<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = ['product_id', 'user_id', 'order_status_id', 'payment_id', 'quantity', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function payment()
    {
        return $this->belongsTo(User::class, 'payment_id');
    }
}
