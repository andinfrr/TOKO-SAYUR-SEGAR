<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KeranjangDetail;
use App\Models\Produk;

class OrderController extends Controller
{
    public function form()
    {
        $keranjang = KeranjangDetail::join('produk', 'produk.id_produk', '=', 'keranjang_detail.id_produk')
            ->select('keranjang_detail.*', 'produk.nama_produk', 'produk.harga')
            ->get();

        return view('checkout.index', compact('keranjang'));

    }

    public function proses(Request $request)
    {
        // 🔒 WAJIB LOGIN
        if (!session()->has('customer')) {
            return redirect('/login');
        }

        $customer = session('customer'); // OBJECT customer
        $keranjang = KeranjangDetail::all();
        $request->validate([
    'alamat_kirim' => 'required',
    'metode_pembayaran' => 'required'
]);


        foreach ($keranjang as $k) {
            $produk = Produk::find($k->id_produk);

            DB::statement("CALL tambah_order(?,?,?,?,?,?,?)", [
                $customer->id_customer,   // ✅ YANG BENAR
                $request->alamat_kirim,
                $request->metode_pembayaran,
                'TRX' . time(),
                $k->id_produk,
                $k->jumlah,
                $produk->harga
            ]);
        }

        // kosongkan keranjang
        KeranjangDetail::truncate();

        return redirect('/')->with('success', 'Checkout berhasil');
    }
}
