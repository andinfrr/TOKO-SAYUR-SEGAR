@extends('layouts.app')
@section('content')

@if(session('error'))
<div class="alert alert-danger text-center">
    {{ session('error') }}
</div>
@endif

<div class="row justify-content-center mt-5">
  <div class="col-md-7 col-lg-6">

    <div class="card border-0 shadow-sm rounded-4 product-card">

      {{-- HEADER --}}
      <div class="card-header text-center rounded-top-4"
           style="background:#dfecc8;">
        <h4 class="mb-1 fw-bold" style="color:#2f5d3a">
          Login Customer
        </h4>
        <small style="color:#2f5d3a">
          Selamat datang di Toko Sayur 🥬
        </small>
      </div>

      {{-- BODY --}}
      <div class="card-body p-4">

        <form method="POST" action="/login">
          @csrf

          <div class="mb-3">
            <label class="form-label fw-semibold" style="color:#2f5d3a">
              Email / Username
            </label>
            <input type="text"
                   name="username"
                   class="form-control rounded-3"
                   placeholder="Masukkan email atau username"
                   required>
          </div>

          <div class="mb-4">
            <label class="form-label fw-semibold" style="color:#2f5d3a">
              Password
            </label>
            <input type="password"
                   name="password"
                   class="form-control rounded-3"
                   placeholder="Masukkan password"
                   required>
          </div>

          <button class="btn btn-success w-100 py-2 fw-bold rounded-pill">
            Login
          </button>
        </form>

      </div>

      {{-- FOOTER --}}
      <div class="card-footer bg-light text-center rounded-bottom-4">
        <small style="color:#2f5d3a">
          Belum punya akun?
          <a href="/register"
             class="fw-bold text-decoration-none"
             style="color:#4caf50">
            Daftar Customer
          </a>
        </small>
      </div>

    </div>

  </div>
</div>

@endsection
