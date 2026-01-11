@extends('layouts.app')

@section('content')

<!-- card utama buat nampilin invoice -->
<div class="card shadow p-4">

    <!-- judul halaman -->
    <h3 class="text-success mb-3">Invoice Pembelian</h3>

    <!-- nama customer diambil dari session invoice pas checkout -->

    <p>
        <strong>Nama Customer:</strong>
        {{ session('invoice.customer')->nama }}
    </p>
    
    <p>
        <strong>Alamat Pengiriman:</strong> 
        {{ session('invoice.alamat') }}
    </p>

    <p>
        <strong>Metode Pembayaran:</strong> 
        {{ session('invoice.metode') }}
    </p>

    <p>
        <strong>Tanggal:</strong>
        {{ session('invoice.tanggal')->format('d-m-Y H:i') }}
    </p>

    <hr>

    <!-- tabel detail pembelian -->
    <table class="table table-bordered">

        <!-- header tabel -->
        <tr class="table-success">
            <th>Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>

        <!-- inisialisasi total harga -->
        @php $total = 0; @endphp

        <!-- looping data keranjang -->
        @foreach($keranjang as $item)

        <!-- hitung subtotal per produk -->
        @php
            $subtotal = $item->harga * $item->jumlah;
            $total += $subtotal;
        @endphp

        <tr>
            <td>{{ $item->nama_produk }}</td>
            <td>Rp {{ number_format($item->harga) }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>Rp {{ number_format($item->harga * $item->jumlah) }}</td>
        </tr>
        @endforeach

        <!-- total keseluruhan -->
        <tr class="fw-bold">
            <td colspan="3" class="text-end">Total</td>
            <td>Rp {{ number_format($total) }}</td>
        </tr>
    </table>

    <div class="text-end mt-3">

        <a href="/" class="btn btn-success">
            Belanja Lagi
        </a>

        <!-- tombol buat cetak invoice -->
        <button onclick="window.print()" class="btn btn-outline-secondary">
            Cetak Invoice
        </button>

    </div>
</div>

@endsection
