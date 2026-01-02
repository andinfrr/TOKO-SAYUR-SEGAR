@extends('layouts.app')

@section('content')
<h4 class="text-success mb-3">
  Kategori: {{ $kategori }}
</h4>

<div class="row">
@foreach($produk as $p)
<div class="col-md-3">
  <div class="card mb-4">
    @if($p->foto)
    <img src="{{ asset('storage/'.$p->foto) }}" class="card-img-top">
    @endif

    <div class="card-body">
      <h5>{{ $p->nama_produk }}</h5>
      <p>Rp {{ number_format($p->harga) }}</p>
      <p>Stok: {{ $p->stok }}</p>
    </div>
  </div>
</div>
@endforeach
</div>
@endsection
