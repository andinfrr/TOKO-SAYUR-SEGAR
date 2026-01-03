@extends('layouts.app')

@section('content')
<h3 class="mb-4 text-success">Dashboard Penjual</h3>

{{-- ================= TOTAL ORDER | PENDAPATAN | TAMBAH PRODUK ================= --}}
<div class="row mb-4 align-items-stretch">

    {{-- TOTAL ORDER --}}
    <div class="col-md-4">
        <div class="card text-bg-success h-100">
            <div class="card-body">
                <h5>Total Order</h5>
                <h2>{{ $totalOrder }}</h2>
            </div>
        </div>
    </div>

    {{-- TOTAL PENDAPATAN --}}
    <div class="col-md-4">
        <div class="card text-bg-success h-100">
            <div class="card-body">
                <h5>Total Pendapatan</h5>
                <h2>Rp {{ number_format($totalPendapatan) }}</h2>
            </div>
        </div>
    </div>

    {{-- TAMBAH PRODUK --}}
    <div class="col-md-4">
        <div class="card border-success h-100">
            <div class="card-body d-flex flex-column justify-content-center">
                <a href="{{ url('/produk/create') }}"
                   class="btn btn-success btn-lg w-100">
                    + Tambah Produk
                </a>
            </div>
        </div>
    </div>

</div>

{{-- ================= PRODUK TERLARIS ================= --}}
<div class="card mb-4">
    <div class="card-header bg-success text-white">
        Produk Terlaris
    </div>
    <div class="card-body">
        <ul class="list-group">
            @foreach($produkTerlaris as $p)
            <li class="list-group-item d-flex justify-content-between">
                {{ $p->nama_produk }}
                <span class="badge bg-success">{{ $p->total_jual }}</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>

{{-- ================= METODE PEMBAYARAN ================= --}}
<div class="card mb-4">
    <div class="card-header bg-success text-white">
        Metode Pembayaran
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Metode Pembayaran</th>
                    <th>Total Order</th>
                </tr>
            </thead>
            <tbody>
                @foreach($metodePembayaran as $m)
                <tr>
                    <td>
                        @switch($m->metode_pembayaran)
                            @case('COD') COD @break
                            @case('TRANSFER_BRI') Transfer BRI @break
                            @case('TRANSFER_BCA') Transfer BCA @break
                            @case('TRANSFER_MANDIRI') Transfer Mandiri @break
                            @case('E_WALLET') E-Wallet @break
                            @default Lainnya
                        @endswitch
                    </td>
                    <td>{{ $m->total_order }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- ================= KELOLA PRODUK ================= --}}
<div class="card mt-4">
    <div class="card-header bg-success text-white">
        Kelola Produk
    </div>

    <div class="card-body">
        <div class="row">
            @foreach($produk as $p)
            <div class="col-md-3 mb-4">
                <div class="card h-100">

                    {{-- FOTO PRODUK --}}
                    <img src="{{ asset('storage/'.$p->foto) }}"
                         class="card-img-top"
                         style="height:160px;object-fit:cover">

                    {{-- INFO PRODUK --}}
                    <div class="card-body">
                        <h6 class="fw-bold">{{ $p->nama_produk }}</h6>

                        <p class="mb-1 text-success">
                            Rp {{ number_format($p->harga) }}
                        </p>

                        <small class="text-muted">
                            Stok: {{ $p->stok }}
                        </small>
                    </div>

                    {{-- TOMBOL EDIT --}}
                    <div class="card-footer bg-white border-0">
                        <a href="{{ url('/produk/'.$p->id_produk.'/edit') }}"
                           class="btn btn-success btn-sm w-100">
                            Edit Produk
                        </a>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
