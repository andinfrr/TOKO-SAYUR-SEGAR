@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-4">
  <div class="col-md-6">
    <div class="card shadow border-0">
    <div class="form-header">
        <span style="font-size:22px"></span>
        <h5>Tambah Produk Sayur</h5>
    </div>

      <div class="card-body p-4">
<!-- Wajib digunakan jika form mengirim file (gambar, dll) -->
        <form method="POST" action="/produk" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label class="form-label fw-semibold">Nama Sayur</label>
            <input type="text"
                   name="nama_produk"
                   class="form-control"
                   placeholder="Contoh: Bayam Hijau"
                   required>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Harga (Rp)</label>
              <input type="number"
                     name="harga"
                     class="form-control"
                     placeholder="5000"
                     required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Stok</label>
              <input type="number"
                     name="stok"
                     class="form-control"
                     placeholder="10"
                     required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Kategori</label>
            <select class="form-control" name="kategori" required>
              <option value="">--Pilih Kategori Sayuran --</option>
              <option value="sayuran">Sayuran</option>
              <option value="Umbi-umbian">Umbi-umbian</option>
              <option value="Rempah">Rempah</option>
              <option value="Kacang-kacangan">Kacang-kacangan</option>
              <option value="Jamur">Jamur</option>
              <option value="Produk olahan">Produk olahan</option>
          </select>

          <div class="mb-4">
            <label class="form-label fw-semibold">Foto Sayur</label>
            <input type="file"
                   name="foto"
                   class="form-control"
                   accept="image/*"
                   required>
          </div>

          <button class="btn btn-success w-100 py-2 fw-bold">
            Simpan Produk
          </button>
        </form>
      </div>
    </div>

  </div>
</div>

@endsection

<style>
h3 {
    font-weight: 700;
    color: #2f5d3a;
}

/* card form */
.form-header {
    background: linear-gradient(135deg, #4caf50, #6fa85f);
    color: white;
    padding: 16px 24px;
    border-radius: 16px 16px 0 0;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.12);
}

.form-header h5 {
    margin: 0;
    font-weight: 700;
}

.form-card {
    border-radius: 16px;
    overflow: hidden;
}

.form-label {
    color: #2f5d3a;
}

.form-control {
    border-radius: 14px;
    border: 1px solid #cfe7c5;
    padding: 10px 14px;
}

.form-control:focus {
    border-color: #6fa85f;
    box-shadow: 0 0 0 .2rem rgba(111,168,95,.25);
}

select.form-control {
    cursor: pointer;
}
/* tombol */
.btn-success {
    background-color: #4caf50;
    border-color: #4caf50;
    border-radius: 30px;
}

.btn-success:hover {
    background-color: #43a047;
    border-color: #43a047;
}

input[type="file"] {
    padding: 8px;
}

@media (max-width: 768px) {
    h3 {
        text-align: center;
    }
}

</style>
