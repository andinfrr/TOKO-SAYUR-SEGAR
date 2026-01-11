<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeranjangDetail extends Model
{
    // Model untuk menyimpan isi keranjang
    // (produk apa dan jumlahnya)

    protected $table = 'keranjang_detail';        // Nama tabel
    protected $primaryKey = 'id_keranjang_detail';// Primary key
    public $timestamps = false;                   // Tanpa created_at & updated_at

    protected $fillable = [
        'id_produk', // ID produk
        'jumlah'     // Jumlah produk
    ];
}
