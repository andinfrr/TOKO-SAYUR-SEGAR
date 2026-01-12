<!-- Halaman checkout.
Dipakai buat mengisi alamat pengiriman
dan milih metode pembayaran sebelum pesanan diproses. -->


@extends('layouts.app')

@section('content')
<h3 class="text-success mb-3">Checkout</h3>

<form action="/checkout" method="POST">
@csrf

<div class="mb-3">
    <label>Alamat Kirim</label>

    <select name="id_alamat" class="form-control" required>
        <option value="">-- Pilih Alamat --</option>

        @foreach ($alamatCustomer as $alamat)
            <option value="{{ $alamat->id_alamat }}">
                {{ $alamat->provinsi }},
                {{ $alamat->kota }},
                {{ $alamat->kecamatan }} -
                {{ $alamat->detail_alamat }}
                @if($alamat->is_utama)
                    (Utama)
                @endif
            </option>
        @endforeach
    </select>

    <a href="{{ url('/alamat/tambah') }}" class="btn btn-sm btn-outline-success mt-2">
        + Tambah Alamat Baru
    </a>
</div>



<div class="mb-3">
    <label class="form-label">Metode Pembayaran</label>
    <select name="metode_pembayaran" class="form-control" required>
        <option value="">-- Pilih Metode Pembayaran --</option>
        <option value="QRIS">QRIS</option>
        <option value="Virtual Account">BRIVA</option>
        <option value="Virtual Account">BCA VA</option>
        <option value="Virtual Account">VA Mandiri</option>
        <option value="Bank">Transfer Bank BRI</option>
        <option value="Bank">Transfer Bank BCA</option>
        <option value="Bank">Transfer Bank Mandiri</option>
        <option value="E-wallet">Gopay</option>
        <option value="E-wallet">DANA</option>
        <option value="E-wallet">OVO</option>
    </select>
</div>


<button class="btn btn-success">
    Proses Checkout
</button>

</form>
@endsection
