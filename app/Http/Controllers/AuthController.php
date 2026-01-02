<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

   public function login(Request $request)
{
    // 1️⃣ CEK PENJUAL (PAKE nama_penjual)
    $penjual = DB::table('penjual')
        ->where('nama_penjual', $request->username)
        ->first();

if ($penjual && $request->password === $penjual->password) {
    Session::put('penjual', $penjual);
    return redirect('/dashboard');
}


    // 2️⃣ CEK CUSTOMER (PAKE email)
    $customer = DB::table('customer')
        ->where('email', $request->username)
        ->first();

    if ($customer && Hash::check($request->password, $customer->password)) {
        Session::put('customer', $customer);
        return redirect('/');
    }

    // 3️⃣ GAGAL SEMUA
    return back()->with('error', 'Username atau password salah');
}



    // public function login(Request $request)
    // {
    //     $customer = DB::table('customer')
    //         ->where('email', $request->email)
    //         ->first();

    //     if (!$customer || !Hash::check($request->password, $customer->password)) {
    //         return back()->with('error', 'Email atau password salah');
    //     }

    //     Session::put('customer', $customer);
    //     return redirect('/');
    // }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        DB::table('customer')->insert([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ]);

        return redirect('/login');
    }

public function logout()
{
    Session::forget('penjual');
    Session::forget('customer');
    return redirect('/');
}

}
