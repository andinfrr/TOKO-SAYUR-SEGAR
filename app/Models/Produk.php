<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{

    // Model untuk menyimpan data produk yang dijual
    protected $table = 'produk'; // Nama tabel
    protected $primaryKey = 'id_produk'; // Primary key
    public $timestamps = false; // Tanpa created_at & updated_at

    protected $fillable = [
        'id_penjual',
        'nama_produk',
        'harga',
        'stok',
        'kategori',
        'foto'
    ];
    
}
