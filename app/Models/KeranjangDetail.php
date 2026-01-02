<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeranjangDetail extends Model
{
    protected $table = 'keranjang_detail';
    protected $primaryKey = 'id_keranjang_detail';
    public $timestamps = false;

    protected $fillable = [
        'id_produk',
        'jumlah'
    ];
}
