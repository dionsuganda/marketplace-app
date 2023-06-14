<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Keranjang extends Model
{
    protected $table = 'tbl_keranjang';

    protected $fillable = [
        'id_user',
        'id_produk',
        'qty',
        'status_checkout'
    ];
}
