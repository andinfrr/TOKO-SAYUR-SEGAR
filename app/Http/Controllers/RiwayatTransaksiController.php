<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatTransaksiController extends Controller
{
  public function index()
{
    // AMBIL DATA CUSTOMER DARI SESSION
    $customer = session('customer');

    // Jika customer belum login, arahkan ke halaman login
    if (!$customer) {
        return redirect('/login');
    }

     // AMBIL DATA RIWAYAT TRANSAKSI dari database
    $riwayat = DB::table('v_riwayat_pembelian_customer')
        ->where('id_customer', $customer->id_customer)
        ->orderByDesc('tanggal_order')   // mengurutkan dari tanggal
        ->get()

        // Mengelompokkan data transaksi berdasarkan status order
        ->groupBy('status_order'); 

    // Kirim data ke view riwayat.index
    return view('riwayat.index', compact('riwayat'));
}
}
