@extends('layouts.app')

@section('content')
<h3 class="text-warning mb-3">Edit Produk</h3>

<form method="POST" action="/produk/{{ $produk->id_produk }}" enctype="multipart/form-data">
@csrf

<div class="mb-2">
    <input type="text" name="nama_produk"
           value="{{ $produk->nama_produk }}"
           class="form-control">
</div>

<div class="mb-2">
    <input type="number" name="harga"
           value="{{ $produk->harga }}"
           class="form-control">
</div>

<div class="mb-2">
    <input type="number" name="stok"
           value="{{ $produk->stok }}"
           class="form-control">
</div>

<div class="mb-2">
    <input type="text" name="kategori"
           value="{{ $produk->kategori }}"
           class="form-control">
</div>

<div class="mb-2">
    <input type="file" name="foto" class="form-control">
</div>

<button class="btn btn-warning">Update</button>
<a href="/" class="btn btn-secondary">Batal</a>
</form>
@endsection
