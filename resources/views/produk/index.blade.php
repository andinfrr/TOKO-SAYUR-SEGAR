@extends('layouts.app')

@section('content')
<div class="row">

{{-- MENU KATEGORI --}}
@isset($kategori)
<div class="kategori-wrapper mb-4">
    <ul class="kategori-list">
        <li>
            <a href="#"
   class="kategori-item"
   data-kategori="Semua">
    Semua
</a>

        </li>

        @foreach($kategori as $k)
        <li>
            <a href="#"
   class="kategori-item"
   data-kategori="{{ $k->kategori }}">
    {{ $k->kategori }}
</a>

        </li>
        @endforeach
    </ul>
</div>
@endisset


<div class="row" id="produk-container">

@foreach($produk as $p)

<div class="col-md-3 mb-4 d-flex">
    {{-- CARD --}}
    <div class="card h-100 w-100 shadow-sm product-card">

        {{-- GAMBAR --}}
        <img src="{{ asset('storage/'.$p->foto) }}"
        class="card-img-top" style="height:200px;object-fit:cover">

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

</div> {{-- end produk-container --}}


</div>

<script>
document.querySelectorAll('.kategori-item').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();

        let kategori = this.dataset.kategori;

        fetch(`/filter-produk?kategori=${kategori}`)
            .then(res => res.json())
            .then(data => {
                let container = document.getElementById('produk-container');
                container.innerHTML = '';

                data.forEach(p => {
                    container.innerHTML += `
                        <div class="col-md-3 mb-4 d-flex">
                            <div class="card h-100 w-100 shadow-sm product-card">
                                <img src="/storage/${p.foto}"
                                     class="card-img-top"
                                     style="height:200px;object-fit:cover">

                                <div class="card-body d-flex flex-column">
                                    <h6 class="fw-bold">${p.nama_produk}</h6>
                                    <p>Rp ${Number(p.harga).toLocaleString('id-ID')}</p>
                                    <small>Stok: ${p.stok}</small>
                                </div>
                            </div>
                        </div>
                    `;
                });
            });
    });
});
</script>


@endsection
