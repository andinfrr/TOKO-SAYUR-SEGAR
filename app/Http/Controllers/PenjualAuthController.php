<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class PenjualAuthController extends Controller
{
    // MENAMPILKAN FORM LOGIN PENJUAL
    public function loginForm()
    {
        // Menuju halaman login khusus penjual
        return view('penjual.login');
    }

     // PROSES LOGIN PENJUAL
    public function login(Request $request)
    {
        // Mengambil data penjual berdasarkan username
        $penjual = DB::table('penjual')
            ->where('username', $request->username)
            ->first();

        // Jika tidak sesuai kembali ke halaman login
        if (!$penjual || !Hash::check($request->password, $penjual->password)) {
            return back()->with('error', 'Login gagal');
        }

        // Jika berhasil diarahkan kehalaman dashboard penjual
        Session::put('penjual', $penjual);
        return redirect('/dashboard');
    }

    // PROSES LOGOUT PENJUA
    public function logout()
    {
        // Menghapus session dan kembali ke halaman login
        Session::forget('penjual');
        return redirect('/penjual/login');
    }
}
