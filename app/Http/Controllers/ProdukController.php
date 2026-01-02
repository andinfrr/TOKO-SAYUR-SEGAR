<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produk;

class ProdukController extends Controller
{
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


    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        Produk::create($request->all());
        return redirect('/produk');
    }

    
    public function edit($id)
{
    $produk = Produk::findOrFail($id);
    return view('produk.edit', compact('produk'));
}

public function update(Request $request, $id)
{
    $produk = Produk::findOrFail($id);

    // kalau upload foto baru
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto')->store('produk', 'public');
        $produk->foto = $foto;
    }

    $produk->update([
        'nama_produk' => $request->nama_produk,
        'harga' => $request->harga,
        'stok' => $request->stok,
        'kategori' => $request->kategori,
    ]);

    return redirect('/');
}

    
}

