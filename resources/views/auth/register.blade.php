<!-- Halaman ini dipakai buat daftar akun customer.
Isinya form registrasi biar user bisa bikin akun baru. -->

@extends('layouts.app')

@section('content')

<!-- Pembungkus utama halaman register -->
<div class="row justify-content-center mt-5">
  <div class="col-md-8 col-lg-7">

    <div class="card border-0 shadow-sm register-card">

      <!-- Bagian header halaman register -->
      <div class="card-header register-header">
        <h4>Register Customer</h4>
        <small>Gabung & belanja sayur segar</small>
      </div>

       <!-- Bagian tengah yg isinya form pendaftaran -->
      <div class="card-body p-4">
        <form method="POST" action="/register">
          @csrf

          <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input name="nama" class="form-control" value="{{ old('nama') }}" placeholder="Nama lengkap" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('nama') }}" placeholder="Email aktif" required>
          </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
        
          <div class="position-relative">
            <input type="password"
                   name="password"
                   id="password"
                   class="form-control"
                   placeholder="Password"
                   required>
        
            <i class="fa-solid fa-eye"
               onclick="togglePassword('password', this)"
               style="
                 position: absolute;
                 top: 50%;
                 right: 15px;
                 transform: translateY(-50%);
                 cursor: pointer;
                 color: #6c757d;
               ">
            </i>
          </div>
        </div>
        
        <div class="mb-3">
          <label class="form-label">Konfirmasi Password</label>
        
          <div class="position-relative">
            <input type="password"
                   name="password_confirmation"
                   id="password_confirmation"
                   class="form-control"
                   placeholder="Ulangi password"
                   required>
        
            <i class="fa-solid fa-eye"
               onclick="togglePassword('password_confirmation', this)"
               style="
                 position: absolute;
                 top: 50%;
                 right: 15px;
                 transform: translateY(-50%);
                 cursor: pointer;
                 color: #6c757d;
               ">
            </i>
          </div>
        </div>


          <div class="mb-3">
            <label class="form-label">No HP</label>
            <input name="no_hp" class="form-control" value="{{ old('nama') }}" placeholder="08xxxxxxxxxx" required>
          </div>

          <div class="mb-4">
            <label class="form-label">Alamat</label>
            <textarea name="alamat"
                      rows="3"
                      class="form-control"
                      value="{{ old('nama') }}"
                      placeholder="Alamat lengkap"
                      required></textarea>
          </div>

          <!-- Tombol buat daftar akun -->
          <button class="btn btn-success w-100 py-2 fw-bold">
            Daftar
          </button>
        </form>
      </div>

      <!-- Bagian bawah halaman register -->
      <div class="card-footer register-footer">
        <small style="color:#2f5d3a">
          Sudah punya akun?
          <a href="/login"
             class="fw-bold text-decoration-none"
             style="color:#4caf50">
            Login
          </a>
        </small>
      </div>

    </div>

  </div>
</div>
<!-- Script show/hide password -->
<script>
function togglePassword(fieldId, icon) {
    const input = document.getElementById(fieldId);

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>

@endsection

<!-- CSS buat tampilan halaman register -->
<style>
    /* ===== REGISTER CUSTOMER ===== */

.register-card {
    border-radius: 24px;
    overflow: hidden;
    background: #fff;
}

.register-header {
    background: #dfecc8;
    text-align: center;
    padding: 18px;
}

.register-header h4 {
    color: #2f5d3a;
    font-weight: 700;
    margin-bottom: 4px;
}

.register-header small {
    color: #2f5d3a;
}

.register-card .card-body {
    background: #f8f9f4;
}

.register-card .form-label {
    color: #2f5d3a;
    font-weight: 600;
}

.register-card .form-control {
    border-radius: 12px;
    border: 1px solid #cfe3b1;
    padding: 10px 14px;
}

.register-card .form-control:focus {
    border-color: #4caf50;
    box-shadow: 0 0 0 0.15rem rgba(76, 175, 80, 0.25);
}

.register-card textarea {
    resize: none;
}

.register-card .btn-success {
    background-color: #4caf50;
    border-color: #4caf50;
    border-radius: 999px;
}

.register-card .btn-success:hover {
    background-color: #43a047;
    border-color: #43a047;
}

.register-footer {
    background: #eef5e6;
    text-align: center;
}

</style>
