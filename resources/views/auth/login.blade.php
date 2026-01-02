@extends('layouts.app')

@section('content')
<h3 class="text-success mb-3">Login Customer</h3>

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form method="POST" action="/login">
@csrf

<input name="username"
       class="form-control mb-2"
       placeholder="Email Customer / Nama Penjual"
       required>

<input type="password"
       name="password"
       class="form-control mb-2"
       placeholder="Password"
       required>

<button class="btn btn-success w-100">
    Login
</button>
</form>


<p class="mt-2">
    Belum punya akun?
    <a href="/register">Daftar</a>
</p>
@endsection
