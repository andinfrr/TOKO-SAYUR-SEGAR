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

    public function tambah($id_produk)
    {
        $produk = Produk::findOrFail($id_produk);

        $item = KeranjangDetail::where('id_produk', $id_produk)->first();

        if ($item) {
            if ($item->jumlah < $produk->stok) {
                $item->increment('jumlah');
            }
        } else {
            KeranjangDetail::create([
                'id_produk' => $id_produk,
                'jumlah' => 1
            ]);
        }

        return redirect('/');
    }

    public function hapus($id)
    {
        KeranjangDetail::destroy($id);
        return redirect('/keranjang');
    }
}
