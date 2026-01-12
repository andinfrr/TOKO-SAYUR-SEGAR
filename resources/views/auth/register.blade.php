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
            <input name="nama" class="form-control" placeholder="Nama lengkap" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email aktif" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>

          <div class="mb-3">
            <label class="form-label">No HP</label>
            <input name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" required>
          </div>

          <div class="mb-3">
    <label>Provinsi</label>
    <select id="provinsi" name="provinsi" class="form-control" required>
        <option value="">-- Pilih Provinsi --</option>
    </select>
</div>
<div class="mb-3">
    <label>Kota / Kabupaten</label>
    <select id="kota" name="kota" class="form-control" required>
        <option value="">-- Pilih Kota --</option>
    </select>
</div>
<div class="mb-3">
    <label>Kecamatan</label>
    <select id="kecamatan" name="kecamatan" class="form-control" required>
        <option value="">-- Pilih Kecamatan --</option>
    </select>
</div>
<div class="mb-3">
    <label>Kode Pos</label>
    <input type="text" name="kode_pos" class="form-control" required>
</div>

<div class="mb-3">
    <label>Detail Alamat</label>
    <textarea name="detail_alamat" class="form-control" rows="3" required></textarea>
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

@push('scripts')
<script>
const provinsiSelect = document.getElementById('provinsi');
const kotaSelect = document.getElementById('kota');
const kecamatanSelect = document.getElementById('kecamatan');

// ===== LOAD PROVINSI =====
fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
    .then(res => res.json())
    .then(data => {
        data.forEach(prov => {
            const option = document.createElement('option');
            option.value = prov.name;
            option.dataset.id = prov.id;
            option.textContent = prov.name;
            provinsiSelect.appendChild(option);
        });
    });

// ===== SAAT PROVINSI DIPILIH =====
provinsiSelect.addEventListener('change', function () {
    const provId = this.selectedOptions[0]?.dataset.id;

    kotaSelect.innerHTML = '<option value="">-- Pilih Kota --</option>';
    kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';

    if (!provId) return;

    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`)
        .then(res => res.json())
        .then(data => {
            data.forEach(kota => {
                const option = document.createElement('option');
                option.value = kota.name;
                option.dataset.id = kota.id;
                option.textContent = kota.name;
                kotaSelect.appendChild(option);
            });
        });
});

// ===== SAAT KOTA DIPILIH =====
kotaSelect.addEventListener('change', function () {
    const kotaId = this.selectedOptions[0]?.dataset.id;

    kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';

    if (!kotaId) return;

    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kotaId}.json`)
        .then(res => res.json())
        .then(data => {
            data.forEach(kec => {
                const option = document.createElement('option');
                option.value = kec.name;
                option.textContent = kec.name;
                kecamatanSelect.appendChild(option);
            });
        });
});
</script>
@endpush

