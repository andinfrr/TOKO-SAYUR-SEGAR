<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /* ===============================
       TAMPIL PRODUK (CUSTOMER)
    =============================== */
    public function index()
    {
        $produk = Produk::all();
        $kategori = Produk::select('kategori')->distinct()->get();

        return view('produk.index', compact('produk', 'kategori'));
    }

    public function showKategori($kategori)
    {
        $produk = Produk::where('kategori', $kategori)->get();
        $kategoriList = Produk::select('kategori')->distinct()->get();

        return view('produk.kategori', [
            'produk' => $produk,
            'kategori' => $kategori,
            'kategoriList' => $kategoriList
        ]);
    }

     public function kategori($kategori)
    {
        $produk = Produk::where('kategori', $kategori)->get();

        return view('produk.kategori', [
            'produk' => $produk,
            'kategori' => $kategori
        ]);
    }

    /* ===============================
       TAMBAH PRODUK
    =============================== */
    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        // VALIDASI
// VALIDASI
$request->validate([
    'nama_produk' => 'required',
    'harga'       => 'required|numeric',
    'stok'        => 'required|numeric',
    'kategori'    => 'required',
    'foto'        => 'required|image|mimes:jpg,jpeg,png|max:2048'
]);

// UPLOAD FOTO
$foto = $request->file('foto')->store('produk', 'public');

// SIMPAN KE DB
Produk::create([
    'id_penjual'  => session('penjual')->id_penjual, // 🔥 PENTING
    'nama_produk' => $request->nama_produk,
    'harga'       => $request->harga,
    'stok'        => $request->stok,
    'kategori'    => $request->kategori,
    'foto'        => $foto
]);

return redirect('/dashboard')->with('success', 'Produk berhasil ditambahkan');

    }

    /* ===============================
       EDIT PRODUK
    =============================== */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        // VALIDASI
        $request->validate([
            'nama_produk' => 'required',
            'harga'       => 'required|numeric',
            'stok'        => 'required|numeric',
            'kategori'    => 'required',
            'foto'        => 'nullable|image'
        ]);

        // KALAU ADA FOTO BARU
        if ($request->hasFile('foto')) {

            // hapus foto lama
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }

            // simpan foto baru
            $foto = $request->file('foto')->store('produk', 'public');
            $produk->foto = $foto;
        }

        // UPDATE DATA
        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'kategori'    => $request->kategori,
        ]);

        return redirect('/dashboard')->with('success', 'Produk berhasil diupdate');
    }
}
