<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // Menampilkan Produk 
    public function index()
    {
        // Mengambil seluruh data produk
        $produk = Produk::all();
        // untuk filter kategori di halaman customer
        $kategori = Produk::select('kategori')->distinct()->get();

        return view('produk.index', compact('produk', 'kategori'));
    }

    // TAMPIL PRODUK BERDASARKAN KATEGORI
     public function kategori($kategori)
    {
        $produk = Produk::where('kategori', $kategori)->get();

        return view('produk.kategori', [
            'produk' => $produk,
            'kategori' => $kategori
        ]);
    }

public function filter(Request $request)
{
    $kategori = $request->kategori;

    if ($kategori == 'Semua') {
        $produk = Produk::all();
    } else {
        $produk = Produk::where('kategori', $kategori)->get();
    }

    return response()->json($produk);
}



    // UNTUK PENJUAL MENAMBAHKAN PRODUK
    public function create()
    {
        //Menampilkan form tambah produk
        return view('produk.create');
    }

    public function store(Request $request)
    {
    
    // Validasi data sebelum disimpan ke database
    $request->validate([
        'nama_produk' => 'required',
        'harga'       => 'required|numeric',
        'stok'        => 'required|numeric',
        'kategori'    => 'required',
        'foto'        => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    // Upload foto dan foto disimpan ke folder public/storage/produk
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

       // EDIT PRODUK
        public function edit($id)
        {
            // Mengambil data produk berdasarkan id
            $produk = Produk::findOrFail($id);
            return view('produk.edit', compact('produk'));
        }

        public function update(Request $request, $id)
        {
            // Ambil data produk
            $produk = Produk::findOrFail($id);

            // Validasi data sebelum disimpan ke database
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
            
            // Kembali ke dashboard
            return redirect('/dashboard')->with('success', 'Produk berhasil diupdate');
        }
    }
