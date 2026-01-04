<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KeranjangDetail;
use App\Models\Produk;

class OrderController extends Controller
{
    /* ===============================
       FORM CHECKOUT
    =============================== */
    public function form()
    {
        $keranjang = KeranjangDetail::join('produk', 'produk.id_produk', '=', 'keranjang_detail.id_produk')
            ->select(
                'keranjang_detail.*',
                'produk.nama_produk',
                'produk.harga',
                'produk.stok'
            )
            ->get();

        return view('checkout.index', compact('keranjang'));
    }

    /* ===============================
       PROSES CHECKOUT
    =============================== */
public function proses(Request $request)
{
    $customer = session('customer');
    if (!$customer) {
        return redirect('/login');
    }

    // ambil keranjang + produk
$keranjang = KeranjangDetail::join('produk', 'produk.id_produk', '=', 'keranjang_detail.id_produk')
    ->select(
        'keranjang_detail.*',
        'produk.nama_produk',
        'produk.harga',
        'produk.stok'
    )
    ->get();


    if ($keranjang->isEmpty()) {
        return back()->with('error', 'Keranjang kosong');
    }

     // 1️ SIMPAN ORDER

$kodeTransaksi = 'TRX-' . now()->format('YmdHis') . '-' . rand(100,999);

$idOrder = DB::table('order')->insertGetId([
    'kode_transaksi'     => $kodeTransaksi, // 🔥 TAMBAH INI
    'id_customer'        => $customer->id_customer,
    'tanggal_order'      => now(),
    'jam_order'          => now(),
    'total_harga'        => $keranjang->sum(fn($k) => $k->harga * $k->jumlah),
    'status_order'       => 'dikemas',
    'status_bayar'       => 'gagal',
    'metode_pembayaran'  => $request->metode_pembayaran,
    'alamat_kirim'       => $request->alamat
]);

    // foreach ($keranjang as $k) {
    //     // kurangi stok
    //     Produk::where('id_produk', $k->id_produk)
    //           ->decrement('stok', $k->jumlah);
    // }

     // 2️ SIMPAN DETAIL ORDER
        foreach ($keranjang as $k) {
            DB::table('order_detail')->insert([
                'id_order' => $idOrder,
                'id_produk' => $k->id_produk,
                'jumlah' => $k->jumlah,
                'harga_satuan' => $k->harga,
            ]);

            // 3️ KURANGI STOK
            Produk::where('id_produk', $k->id_produk)
                ->decrement('stok', $k->jumlah);
        }
        //Kosongkan keranjang
  foreach ($keranjang as $k) {
    DB::table('keranjang_detail')
        ->where('id_keranjang_detail', $k->id_keranjang_detail)
        ->delete();
    return redirect('/invoice')->with('success', 'Checkout berhasil');
  }
session([
    'invoice' => [
        'customer' => $customer,
        'items'    => $keranjang,
        'alamat'   => $request->alamat,
        'metode'   => $request->metode_pembayaran,
        'tanggal'  => now()
    ]
]);

session()->forget('penjual'); // 🔥 PENTING

    // 🔥 KOSONGKAN KERANJANG
    KeranjangDetail::truncate();

    // return redirect('/')->with('success', 'Checkout berhasil');
    return redirect('/invoice');
    
}

public function updateStatus(Request $request, $id)
{
    DB::table('order')
        ->where('id_order', $id)
        ->update([
            'status_order' => $request->status_order
        ]);

    return back()->with('success', 'Status order berhasil diupdate');
}

public function detail($id)
{
    $detail = DB::table('v_detail_order')
        ->where('id_order', $id)
        ->get();

    return response()->json($detail);
}

}