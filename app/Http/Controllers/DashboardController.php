<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
         if (!session()->has('penjual')) {
        return redirect('/penjual/login');
    }
    
        $totalOrder = DB::table('order')->count();

        $totalPendapatan = DB::table('order_detail')
    ->select(DB::raw('SUM(jumlah * harga_satuan) as total'))
    ->value('total');


        $produkTerlaris = DB::table('order_detail')
            ->join('produk', 'produk.id_produk', '=', 'order_detail.id_produk')
            ->select('produk.nama_produk', DB::raw('SUM(order_detail.jumlah) as total_jual'))
            ->groupBy('produk.nama_produk')
            ->orderByDesc('total_jual')
            ->limit(5)
            ->get();

        $metodePembayaran = DB::table('order')
    ->select(
        'metode_pembayaran',
        DB::raw('COUNT(*) as total_order')
    )
    ->groupBy('metode_pembayaran')
    ->get();

        
        
return view('dashboard.index', compact(
    'totalOrder',
    'totalPendapatan',
    'produkTerlaris',
    'metodePembayaran'
));

    }
}
