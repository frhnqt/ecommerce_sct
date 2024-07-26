<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartmodel extends Model
{
    use HasFactory;
    protected $table = "tbl_cart";
    protected $fillable = [
        'product_id',
        'user_id',
        'totalbelanja',
        'quantity',
        'status_cart'
    ];
}
