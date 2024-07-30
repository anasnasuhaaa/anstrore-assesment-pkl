<?php

namespace App\Models;

use App\Models\OrderDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use SebastianBergmann\Invoker\ProcessControlExtensionNotLoadedException;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = ['name', 'image'];

    public function order_detail(): HasMany
    {
        return $this->hasMany(OrderDetails::class, 'payment_id');
    }
}
