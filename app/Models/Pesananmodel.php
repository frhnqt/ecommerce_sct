<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesananmodel extends Model
{
    use HasFactory;
    protected $table = "tbl_pesanan";
    protected $fillable = [
        'product_id',
        'cart_id',
        'user_id',
        'tanggal_pesanan',
        'kodepesanan',
        'status_pesanan'
    ];
}
