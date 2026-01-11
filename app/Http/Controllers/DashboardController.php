<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // CEK LOGIN PENJUAL
        if (!session()->has('penjual')) {
            return redirect('/penjual/login');
        }

        // TOTAL ORDER 
        // Menghitung seluruh data order yang ada di tabel order
        $totalOrder = DB::table('order')->count();

        // TOTAL PENDAPATAN 
        $totalPendapatan = DB::table('order_detail')
            ->select(DB::raw('SUM(jumlah * harga_satuan) as total'))
            ->value('total');

         // ORDERAN MASUK 
        $orderMasuk = DB::table('v_laporan_order')
            ->orderByDesc('tanggal_order')
            ->get();


        // PRODUK TERLARIS
        $produkTerlaris = DB::table('order_detail')
            ->join('produk', 'produk.id_produk', '=', 'order_detail.id_produk')
            ->select(
                'produk.nama_produk',
                // Menjumlahkan total produk yang terjual
                DB::raw('SUM(order_detail.jumlah) as total_jual')
            )
            ->groupBy('produk.nama_produk')
            ->orderByDesc('total_jual')
            ->limit(5)
            ->get();

        // DATA PRODUK (KELOLA PRODUK)
        $produk = DB::table('produk')->get();

        // KIRIM KE VIEW 
        return view('dashboard.index', compact(
            'totalOrder',
            'totalPendapatan',
            'orderMasuk',
            'produkTerlaris',
            'produk'
        ));
    }
}
