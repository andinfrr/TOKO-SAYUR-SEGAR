<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatTransaksiController extends Controller
{
  public function index()
{
    $customer = session('customer');

    if (!$customer) {
        return redirect('/login');
    }

    $riwayat = DB::table('v_riwayat_pembelian_customer')
        ->where('id_customer', $customer->id_customer)
        ->orderByDesc('tanggal_order')
        ->get()
        ->groupBy('status_order'); // 🔥 INI KUNCI NYA

    return view('riwayat.index', compact('riwayat'));
}
}
