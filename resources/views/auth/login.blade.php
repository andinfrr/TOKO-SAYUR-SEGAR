@extends('layouts.app')

@section('content')

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="row justify-content-center mt-5">
  <div class="col-md-5">
    <div class="card shadow-lg border-0">
      
      <div class="card-header text-center text-white"
           style="background:#2e7d32">
        <h4 class="mb-0 fw-bold">Login</h4>
      </div>

      <div class="card-body p-4">
        <form method="POST" action="/login">
          @csrf

          {{-- ERROR --}}
          @if(session('error'))
          <div class="alert alert-danger text-center">
            {{ session('error') }}
          </div>
          @endif

          <div class="mb-3">
            <label class="form-label fw-semibold">
              Email/Username
            </label>
            <input type="text"
                   name="username"
                   class="form-control"
                   placeholder="Masukkan Email/Username"
                   required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">
              Password
            </label>
            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Masukkan Password"
                   required>
          </div>

          <button class="btn btn-success w-100 py-2 fw-bold">
            Login
          </button>
        </form>
      </div>

      <div class="card-footer text-center bg-light">
        <small>
          Belum punya akun?
          <a href="/register" class="text-success fw-bold">
            Daftar Customer
          </a>
        </small>
      </div>

    </div>
  </div>
</div>

@endsection
