<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlistmodel extends Model
{
    use HasFactory;

    protected $table = 'wishlists';

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];
}