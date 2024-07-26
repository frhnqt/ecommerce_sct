<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendormodel extends Model
{
    use HasFactory;
    protected $table = "tbl_vendor";
    protected $fillable = [
        'namavendor', 
        'gambar'
    ];
}
