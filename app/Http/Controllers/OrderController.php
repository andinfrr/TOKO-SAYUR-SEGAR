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
        // 🔒 WAJIB LOGIN CUSTOMER
        if (!session()->has('customer')) {
            return redirect('/login')->with('error', 'Silakan login dulu');
        }

        // VALIDASI FORM
        $request->validate([
            'alamat_kirim' => 'required',
            'metode_pembayaran' => 'required'
        ]);

        $customer = session('customer');
        $keranjang = KeranjangDetail::all();

        // CEK KERANJANG KOSONG
        if ($keranjang->count() == 0) {
            return redirect('/keranjang')->with('error', 'Keranjang kosong');
        }

        DB::beginTransaction();

        try {
            // 🔹 BUAT ORDER
            $orderId = DB::table('order')->insertGetId([
                'id_customer' => $customer->id_customer,
                'alamat_kirim' => $request->alamat_kirim,
                'metode_pembayaran' => $request->metode_pembayaran,
                'kode_transaksi' => 'TRX' . time(),
                'created_at' => now()
            ]);

            // 🔹 LOOP ISI ORDER DETAIL
            foreach ($keranjang as $k) {

                $produk = Produk::findOrFail($k->id_produk);

                // CEK STOK
                if ($produk->stok < $k->jumlah) {
                    DB::rollBack();
                    return redirect('/keranjang')
                        ->with('error', 'Stok produk tidak mencukupi');
                }

                // INSERT ORDER DETAIL
                DB::table('order_detail')->insert([
                    'id_order' => $orderId,
                    'id_produk' => $k->id_produk,
                    'jumlah' => $k->jumlah,
                    'harga_satuan' => $produk->harga
                ]);

                // KURANGI STOK
                $produk->update([
                    'stok' => $produk->stok - $k->jumlah
                ]);
            }

            // KOSONGKAN KERANJANG
            KeranjangDetail::truncate();

            DB::commit();

            return redirect('/')->with('success', 'Checkout berhasil 🎉');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/checkout')->with('error', 'Checkout gagal');
        }
    }
}
