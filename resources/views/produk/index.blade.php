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

            {{-- FORM TAMBAH KE KERANJANG + JUMLAH --}}
            <form action="/keranjang/tambah" method="POST">
                @csrf

                <input type="hidden" name="id_produk" value="{{ $p->id_produk }}">

                <div class="input-group mb-2">
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="this.nextElementSibling.stepDown()">−</button>

                    <input type="number"
                           name="jumlah"
                           class="form-control text-center"
                           value="1"
                           min="1"
                           max="{{ $p->stok }}">

                    <button type="button" class="btn btn-outline-secondary"
                        onclick="this.previousElementSibling.stepUp()">+</button>
                </div>

                <button class="btn btn-success btn-sm w-100">
                    Tambah ke Keranjang
                </button>
            </form>

        </div>
    </div>
</div>
@endforeach
</div>
@endsection
