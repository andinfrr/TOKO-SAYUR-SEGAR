<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Model untuk menyimpan data pesanan / transaksi

    protected $table = 'order';      // Nama tabel
    protected $primaryKey = 'id_order'; // Primary key
    public $timestamps = false;      // Tanpa created_at & updated_at
}
