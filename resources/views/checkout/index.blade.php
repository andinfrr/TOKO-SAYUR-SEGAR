@extends('layouts.app')

@section('content')
<h3 class="text-success mb-3">Checkout</h3>

<form action="/checkout" method="POST">
@csrf

<div class="mb-3">
    <label>Alamat Kirim</label>
    <textarea name="alamat" class="form-control" required></textarea>
</div>

<div class="mb-3">
    <label class="form-label">Metode Pembayaran</label>
    <select name="metode_pembayaran" class="form-control" required>
        <option value="">-- Pilih Metode Pembayaran --</option>
        <option value="COD">COD (Bayar di Tempat)</option>
        <option value="TRANSFER_BRI">Transfer Bank BRI</option>
        <option value="TRANSFER_BCA">Transfer Bank BCA</option>
        <option value="TRANSFER_MANDIRI">Transfer Bank Mandiri</option>
        <option value="E_WALLET">E-Wallet</option>
    </select>
</div>


<button class="btn btn-success">
    Proses Checkout
</button>

</form>
@endsection
