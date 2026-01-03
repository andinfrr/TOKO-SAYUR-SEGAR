<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    public $timestamps = false;

    protected $fillable = [
        'id_penjual',
        'nama_produk',
        'harga',
        'stok',
        'kategori',
        'foto'
    ];
    
}
