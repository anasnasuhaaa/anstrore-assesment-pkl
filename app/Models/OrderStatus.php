<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderStatus extends Model
{
    use HasFactory;
    protected $table = 'order_status';
    protected $fillable = ['name'];

    public function order_detail(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'order_status_id');
    }
}