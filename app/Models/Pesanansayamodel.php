<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanansayamodel extends Model
{
    use HasFactory;
    protected $table = 'tbl_pesanan_saya';
    protected $fillable = [
        'kodepesanan', 
        'user_id', 
        'product_id', 
        'quantity', 
        'harga',
    ];
}
