@extends('layouts.app')

@section('content')
<h3 class="mb-4 text-success">Dashboard Penjual</h3>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card text-bg-success">
            <div class="card-body">
                <h5>Total Order</h5>
                <h2>{{ $totalOrder }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card text-bg-success">
            <div class="card-body">
                <h5>Total Pendapatan</h5>
                <h2>Rp {{ number_format($totalPendapatan) }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card">
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

    <div class="card mt-4">
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
                    <!-- <td>{{ $m->metode_pembayaran }}</td> -->
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

</div>
@endsection
