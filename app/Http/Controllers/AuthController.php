<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // MENAMPILKAN HALAMAN LOGIN
    public function loginForm()
    {
        return view('auth.login');
    }

   public function login(Request $request)
{
    // LOGIN PENJUAL (nama_penjual + password plain)
    $penjual = DB::table('penjual')
        ->where('nama_penjual', $request->username)
        ->first();

    if ($penjual && $request->password === $penjual->password) {
        Session::put('penjual', $penjual);
        return redirect('/dashboard');
    }

    // LOGIN CUSTOMER (email + bcrypt)
    $customer = DB::table('customer')
        ->where('email', $request->username)
        ->first();

    if ($customer && $request->password === $customer->password) {
        Session::put('customer', $customer);
        return redirect('/');
    }
        return back()->with('error', 'Username atau password salah');
    }

    // FORM REGISTER
public function registerForm()
{
    return view('auth.register');
}

   // PROSES REGISTER CUSTOMER
public function register(Request $request)
{
    // VALIDASI INPUT
    $request->validate([
        'nama' => 'required|string|max:100',
        'email' => 'required|email|unique:customer,email',
        'password' => 'required|confirmed',
        'no_hp' => 'required',
        'alamat' => 'required',
    ], [
        'password.confirmed' => 'Password dan konfirmasi password tidak sama.',
    ]);

    // SIMPAN KE DATABASE
    DB::table('customer')->insert([
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'no_hp' => $request->no_hp,
        'alamat' => $request->alamat
    ]);

    return redirect('/login')->with('success', 'Registrasi berhasil, silakan login');
}


    // LOGOUT
    public function logout()
    {
        Session::forget('penjual');
        Session::forget('customer');
        return redirect('/');
    }

    }
