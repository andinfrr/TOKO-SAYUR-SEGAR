@extends('layouts.app')

@section('content')
<div class="row">

@foreach($produk as $p)
<div class="col-md-3 mb-4 d-flex">
    {{-- CARD --}}
    <div class="card h-100 w-100 shadow-sm">

        {{-- GAMBAR --}}
        <img src="{{ asset('storage/'.$p->foto) }}"
             class="card-img-top product-img">

        {{-- ISI --}}
        <div class="card-body d-flex flex-column">

            <h6 class="fw-bold product-title">
                {{ $p->nama_produk }}
            </h6>

            <p class="mb-1">
                Rp {{ number_format($p->harga) }}
            </p>

            <small class="text-muted mb-3">
                Stok: {{ $p->stok }}
            </small>

            {{-- FORM --}}
            <form action="/keranjang/tambah" method="POST" class="mt-auto">
                @csrf

                <input type="hidden" name="id_produk" value="{{ $p->id_produk }}">

                <div class="input-group mb-2">
                    <button type="button"
                            class="btn btn-outline-secondary"
                            onclick="this.nextElementSibling.stepDown()">−</button>

                    <input type="number"
                           name="jumlah"
                           class="form-control text-center"
                           value="1"
                           min="1"
                           max="{{ $p->stok }}">

                    <button type="button"
                            class="btn btn-outline-secondary"
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
