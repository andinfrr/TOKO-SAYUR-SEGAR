@extends('layouts.app')

@section('content')
<style>
  /* ===== LOGIN PAGE ===== */

.login-wrapper {
    min-height: 80vh;
    display: flex;
    align-items: center;
}

/* CARD */
.login-card {
    border-radius: 20px;
    overflow: hidden;
    background: #ffffff;
}

/* HEADER */
.login-header {
    background: linear-gradient(135deg, #4caf50, #6fa85f);
    color: #fff;
    padding: 18px;
    text-align: center;
}

.login-header h4 {
    margin: 0;
    font-weight: 700;
}

/* BODY */
.login-card .card-body {
    background: #f8f9f4;
}

/* INPUT */
.login-card .form-control {
    border-radius: 12px;
    padding: 10px 14px;
    border: 1px solid #cfe3b1;
}

.login-card .form-control:focus {
    border-color: #4caf50;
    box-shadow: 0 0 0 0.15rem rgba(76, 175, 80, 0.25);
}

/* BUTTON */
.login-card .btn-success {
    background-color: #4caf50;
    border-color: #4caf50;
    border-radius: 30px;
}

.login-card .btn-success:hover {
    background-color: #43a047;
    border-color: #43a047;
}

/* FOOTER */
.login-card .card-footer {
    background: #eef5e6;
    border-top: none;
}

.login-card a {
    text-decoration: none;
}

</style>

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="row justify-content-center mt-5 login-wrapper">
  <div class="col-md-5">
    <div class="card shadow-lg border-0 login-card">
      
<div class="card-header login-header">
    <h4>Login</h4>
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
