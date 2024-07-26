<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\Invoker\ProcessControlExtensionNotLoadedException;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = ['name', 'image'];
}
