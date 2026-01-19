<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function index()
    {
        if (!Session::has('customer')) {
            return redirect('/login');
        }

        $customer = Session::get('customer');

        $alamat = DB::table('alamat_customer')
            ->where('id_customer', $customer->id_customer)
            ->where('is_utama', 1)
            ->first();

        return view('akun', compact('customer', 'alamat'));
    }

    public function update(Request $request)
    {
        $customer = Session::get('customer');

        DB::table('customer')
            ->where('id_customer', $customer->id_customer)
            ->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'updated_at' => now()
            ]);

        DB::table('alamat_customer')
            ->where('id_customer', $customer->id_customer)
            ->where('is_utama', 1)
            ->update([
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kode_pos' => $request->kode_pos,
                'detail_alamat' => $request->detail_alamat,
                'updated_at' => now()
            ]);

        // refresh session data
        $customerBaru = DB::table('customer')
            ->where('id_customer', $customer->id_customer)
            ->first();

        Session::put('customer', $customerBaru);

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}
