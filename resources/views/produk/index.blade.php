@extends('layouts.app')

@section('content')
<div class="row">
@foreach($produk as $p)
<div class="col-md-3">
    <div class="card mb-4 shadow-sm">
        <img src="{{ asset('storage/'.$p->foto) }}" class="card-img-top">
        <div class="card-body">
            <h5>{{ $p->nama_produk }}</h5>
            <p>Rp {{ number_format($p->harga) }}</p>
            <p>Stok: {{ $p->stok }}</p>
            
            <a href="/produk/{{ $p->id_produk }}/edit"
               class="btn btn-warning btn-sm">
               Edit
            </a>

            <a href="/keranjang/tambah/{{ $p->id_produk }}"
   class="btn btn-success btn-sm w-100">
   Tambah ke Keranjang
</a>

        </div>
    </div>

</div>
@endforeach
</div>
@endsection
