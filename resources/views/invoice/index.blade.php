@extends('layouts.app')

@section('content')
<div class="card shadow p-4">
    <h3 class="text-success mb-3">Invoice Pembelian</h3>

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
    {{ session('invoice.metode')}}
    </p>

    <p>
        <strong>Tanggal:</strong>
        {{ session('invoice.tanggal')->format('d-m-Y H:i') }}
    </p>

    <hr>

    <table class="table table-bordered">
        <tr class="table-success">
            <th>Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
@php $total = 0; @endphp

@foreach($keranjang as $item)
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


        <tr class="fw-bold">
            <td colspan="3" class="text-end">Total</td>
            <td>Rp {{ number_format($total) }}</td>
        </tr>
    </table>

    <div class="text-end mt-3">
        <a href="/" class="btn btn-success">
            Belanja Lagi
        </a>
        <button onclick="window.print()" class="btn btn-outline-secondary">
            Cetak Invoice
        </button>
    </div>
</div>
@endsection
