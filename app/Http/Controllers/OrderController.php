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

    foreach ($keranjang as $k) {
        // kurangi stok
        Produk::where('id_produk', $k->id_produk)
              ->decrement('stok', $k->jumlah);
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
}