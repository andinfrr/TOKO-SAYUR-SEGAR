<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class PenjualAuthController extends Controller
{
    public function loginForm()
    {
        return view('penjual.login');
    }

    public function login(Request $request)
    {
        $penjual = DB::table('penjual')
            ->where('username', $request->username)
            ->first();

        if (!$penjual || !Hash::check($request->password, $penjual->password)) {
            return back()->with('error', 'Login gagal');
        }

        Session::put('penjual', $penjual);
        return redirect('/dashboard');
    }

    public function logout()
    {
        Session::forget('penjual');
        return redirect('/penjual/login');
    }
}
