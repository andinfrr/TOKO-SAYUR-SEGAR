<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeranjangDetail;
use App\Models\Produk;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = KeranjangDetail::join('produk', 'produk.id_produk', '=', 'keranjang_detail.id_produk')
            ->select('keranjang_detail.*', 'produk.nama_produk', 'produk.harga')
            ->get();

        return view('keranjang.index', compact('keranjang'));
    }

     public function tambah(Request $request)
    {
        $id_produk = $request->id_produk;
        $jumlah    = $request->jumlah;

        $produk = Produk::findOrFail($id_produk);

        // cek item di keranjang (TANPA id_customer)
        $item = KeranjangDetail::where('id_produk', $id_produk)->first();

        if ($item) {
            if ($item->jumlah + $jumlah <= $produk->stok) {
                $item->update([
                    'jumlah' => $item->jumlah + $jumlah
                ]);
            }
        } else {
            KeranjangDetail::create([
                'id_produk' => $id_produk,
                'jumlah'    => $jumlah
            ]);
        }

        return back()->with('success', 'Produk ditambahkan ke keranjang');
    }

public function kurang($id)
{
    $item = KeranjangDetail::findOrFail($id);

    if ($item->jumlah > 1) {
        $item->decrement('jumlah');
    } else {
        // kalau jumlah = 1, hapus produknya
        $item->delete();
    }

    return back();
}

    public function hapus($id)
    {
        KeranjangDetail::destroy($id);
        return redirect('/keranjang');
    }
}
