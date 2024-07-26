<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoicemodel extends Model
{
    use HasFactory;
    protected $table = "tbl_invoice";
    protected $fillable = [
        'kodeinvoice',
        'tanggal_pesanan',
        'kodepesanan',
        'status',
        'cartid',
        'cekoutid'
    ];
}
