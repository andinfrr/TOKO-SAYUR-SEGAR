<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlamatCustomerController extends Controller
{
    // form tambah alamat
    public function create()
    {
        return view('alamat.tambah');
    }

    // simpan alamat
    public function store(Request $request)
{
    DB::table('alamat_customer')->insert([
        'id_customer'   => session('customer')->id_customer,
        'provinsi'      => $request->provinsi,
        'kota'          => $request->kota,
        'kecamatan'     => $request->kecamatan,
        'kode_pos'      => $request->kode_pos,
        'detail_alamat' => $request->detail_alamat,
        'is_utama'      => 0,
        'created_at'    => now(),
        'updated_at'    => now(),
    ]);

    return redirect('/checkout')
        ->with('success', 'Alamat berhasil ditambahkan');
}

}
