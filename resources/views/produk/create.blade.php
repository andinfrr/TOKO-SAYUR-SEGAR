@extends('layouts.app')

@section('content')
<h3 class="text-success mb-3">Tambah Produk Sayur</h3>

<form method="POST" action="/produk" enctype="multipart/form-data">
    @csrf

    <div class="mb-2">
        <input type="text" name="nama_produk" class="form-control" placeholder="Nama Sayur">
    </div>

    <div class="mb-2">
        <input type="number" name="harga" class="form-control" placeholder="Harga">
    </div>

    <div class="mb-2">
        <input type="number" name="stok" class="form-control" placeholder="Stok">
    </div>

    <div class="mb-2">
        <input type="text" name="kategori" class="form-control" placeholder="Kategori">
    </div>

    <button class="btn btn-success">Simpan</button>
</form>
@endsection
