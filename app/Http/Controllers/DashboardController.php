<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // CEK LOGIN PENJUAL
        if (!session()->has('penjual')) {
            return redirect('/penjual/login');
        }

    // MODE TANGGAL 
    $tanggal = $request->get('tanggal');

    if ($tanggal) {
        // MODE HARIAN
        $carbon = Carbon::parse($tanggal);
        $mode = 'harian';
    } else {
        // MODE BULANAN
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');

        if ($bulan && $tahun) {
            $carbon = Carbon::createFromDate($tahun, $bulan, 1);
        } else {
            $carbon = Carbon::now();
        }

        $mode = 'bulanan';
    }

    $selectedTanggal = $carbon->toDateString();
    $selectedBulan   = $carbon->month;
    $selectedTahun   = $carbon->year;

    // KALENDER
    $currentDate = Carbon::createFromDate($selectedTahun, $selectedBulan, 1);

    $prevDate = $currentDate->copy()->subMonth();
    $nextDate = $currentDate->copy()->addMonth();

    $prev = (object)[
        'bulan' => $prevDate->month,
        'tahun' => $prevDate->year,
    ];

    $next = (object)[
        'bulan' => $nextDate->month,
        'tahun' => $nextDate->year,
    ];

    // total order
    $totalOrder = DB::table('order')
    ->when($mode == 'harian', function ($q) use ($selectedTanggal) {
        $q->whereDate('tanggal_order', $selectedTanggal);
    }, function ($q) use ($selectedBulan, $selectedTahun) {
        $q->whereYear('tanggal_order', $selectedTahun)
          ->whereMonth('tanggal_order', $selectedBulan);
    })
    ->count();

    // total pendapatan
    $totalPendapatan = DB::table('order_detail')
    ->join('order', 'order.id_order', '=', 'order_detail.id_order')
    ->when($mode == 'harian', function ($q) use ($selectedTanggal) {
        $q->whereDate('order.tanggal_order', $selectedTanggal);
    }, function ($q) use ($selectedBulan, $selectedTahun) {
        $q->whereYear('order.tanggal_order', $selectedTahun)
          ->whereMonth('order.tanggal_order', $selectedBulan);
    })
    ->sum(DB::raw('order_detail.jumlah * order_detail.harga_satuan'));
        
    // ORDERAN MASUK 
    $orderMasuk = DB::table('v_laporan_order')
    ->when($mode == 'harian', function ($q) use ($selectedTanggal) {
        $q->whereDate('tanggal_order', $selectedTanggal);
    }, function ($q) use ($selectedBulan, $selectedTahun) {
        $q->whereYear('tanggal_order', $selectedTahun)
          ->whereMonth('tanggal_order', $selectedBulan);
    })
    ->orderByDesc('tanggal_order')
    ->get()
    ->groupBy('id_order')
    ->map(fn ($g) => $g->first());


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
            'selectedTanggal',
            'selectedBulan',
            'selectedTahun',
            'prev',
            'next',
            'totalOrder',
            'totalPendapatan',
            'orderMasuk',
            'produkTerlaris',
            'produk'
        ));
    }
}
