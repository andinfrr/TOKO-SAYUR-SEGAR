<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlamatCustomer extends Model
{
    protected $table = 'alamat_customer';
    protected $primaryKey = 'id_alamat';

    protected $fillable = [
        'id_customer',
        'provinsi',
        'kota',
        'kecamatan',
        'kode_pos',
        'detail_alamat',
        'is_utama'
    ];
}
