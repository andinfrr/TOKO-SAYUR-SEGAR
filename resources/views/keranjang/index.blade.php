@extends('layouts.app')

@section('content')

<h3 class="text-success mb-3">Keranjang Belanja</h3>

<!-- tabel daftar produk di keranjang -->
<table class="table table-bordered">
<tr>
    <th>Produk</th>
    <th>Harga</th>
    <th>Jumlah</th>
    <th>Subtotal</th>
    <th>Aksi</th>
</tr>


@php $total = 0; @endphp


@foreach($keranjang as $k)


@php
$subtotal = $k->harga * $k->jumlah;
$total += $subtotal;
@endphp

<tr>
    <td>{{ $k->nama_produk }}</td>
    <td>Rp {{ number_format($k->harga) }}</td>
    <td>{{ $k->jumlah }}</td>
    <td>Rp {{ number_format($subtotal) }}</td>
    <td>

        <!-- tombol buat ngurangin jumlah produk -->
        <a href="/keranjang/kurang/{{ $k->id_keranjang_detail }}" 
           class="btn btn-warning btn-sm">
           -
        </a>

        <!-- tombol buat hapus produk dari keranjang -->
        <a href="/keranjang/hapus/{{ $k->id_keranjang_detail }}" 
           class="btn btn-danger btn-sm"
           onclick="return confirm('Hapus produk ini?')">
           Hapus
        </a>

    </td>
</tr>
@endforeach


<tr>
    <th colspan="3">Total</th>
    <th>Rp {{ number_format($total) }}</th>
    <th></th>
</tr>
</table>


<a href="/" class="btn btn-secondary">Belanja Lagi</a>


<a href="/checkout" class="btn btn-success">
    Checkout
</a>

@endsection
