@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="text-warning mb-4">✏️ Edit Produk</h3>

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form 
        method="POST" 
        action="/produk/{{ $produk->id_produk }}" 
        enctype="multipart/form-data"
    >
        @csrf

        {{-- NAMA PRODUK --}}
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input 
                type="text" 
                name="nama_produk"
                value="{{ old('nama_produk', $produk->nama_produk) }}"
                class="form-control"
                required
            >
        </div>

        {{-- HARGA --}}
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input 
                type="number" 
                name="harga"
                value="{{ old('harga', $produk->harga) }}"
                class="form-control"
                required
            >
        </div>

        {{-- STOK --}}
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input 
                type="number" 
                name="stok"
                value="{{ old('stok', $produk->stok) }}"
                class="form-control"
                required
            >
        </div>

        {{-- KATEGORI --}}
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input 
                type="text" 
                name="kategori"
                value="{{ old('kategori', $produk->kategori) }}"
                class="form-control"
                required
            >
        </div>

        {{-- FOTO LAMA --}}
        @if ($produk->foto)
        <div class="mb-3">
            <label class="form-label">Foto Saat Ini</label><br>
            <img 
                src="{{ asset('storage/'.$produk->foto) }}" 
                width="120" 
                class="rounded shadow"
            >
        </div>
        @endif

        {{-- FOTO BARU --}}
        <div class="mb-4">
            <label class="form-label">Ganti Foto (Opsional)</label>
            <input 
                type="file" 
                name="foto" 
                class="form-control"
            >
        </div>

        {{-- BUTTON --}}
        <button type="submit" class="btn btn-warning">
            💾 Update Produk
        </button>

        <a href="/dashboard" class="btn btn-secondary">
            ❌ Batal
        </a>

    </form>

</div>
@endsection
