<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productmodel extends Model
{
    use HasFactory;
    protected $table = "tbl_product";
    protected $fillable = [
        'kodeproduct', 
        'namaproduct', 
        'stok', 
        'merkid', 
        'categoryid', 
        'harga', 
        'deskripsi', 
        'gambar'
    ];
}
