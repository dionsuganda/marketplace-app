<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'tbl_produk';

    protected $fillable = [
        'nama_produk',
        'image',
        'harga',
        'stock'
    ];
}
