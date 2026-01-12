<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // Model untuk menyimpan data akun pengguna (login & autentikasi)

    use HasFactory, Notifiable;

    // Kolom yang boleh diisi (saat register / input user)
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Kolom yang disembunyikan demi keamanan
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Pengaturan tipe data otomatis
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // password otomatis di-hash
        ];
    }

    public function alamat()
{
    return $this->hasMany(AlamatCustomer::class, 'id_customer', 'id_customer');
}

}
