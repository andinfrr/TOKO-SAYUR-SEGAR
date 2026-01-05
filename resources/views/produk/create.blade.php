@extends('layouts.app')

@section('content')
<h3 class="text-success mb-3">Tambah Produk Sayur</h3>


<div class="row justify-content-center mt-4">
  <div class="col-md-6">

    <div class="card shadow border-0">
      <div class="card-header text-white fw-bold"
           style="background:#2e7d32">
        🥬 Tambah Produk Sayur
      </div>

      <div class="card-body p-4">
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
