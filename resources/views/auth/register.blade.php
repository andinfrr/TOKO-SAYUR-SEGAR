@extends('layouts.app')

@section('content')
<h3 class="text-success mb-3">Register Customer</h3>

<form method="POST" action="/register">
@csrf

<input name="nama" class="form-control mb-2" placeholder="Nama Lengkap" required>
<input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
<input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
<input name="no_hp" class="form-control mb-2" placeholder="No HP" required>
<textarea name="alamat" class="form-control mb-2" placeholder="Alamat" required></textarea>

<button class="btn btn-success w-100">Daftar</button>
</form>
@endsection
