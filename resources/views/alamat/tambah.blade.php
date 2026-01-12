@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Tambah Alamat Baru</h4>

    <form method="POST" action="/alamat/simpan">
        @csrf

        <!-- DROPDOWN PROVINSI -->
        <div class="mb-3">
            <label>Provinsi</label>
            <select id="provinsi" name="provinsi" class="form-control" required>
                <option value="">-- Pilih Provinsi --</option>
            </select>
        </div>

        <!-- DROPDOWN KOTA -->
        <div class="mb-3">
            <label>Kota / Kabupaten</label>
            <select id="kota" name="kota" class="form-control" required>
                <option value="">-- Pilih Kota --</option>
            </select>
        </div>

        <!-- DROPDOWN KECAMATAN -->
        <div class="mb-3">
            <label>Kecamatan</label>
            <select id="kecamatan" name="kecamatan" class="form-control" required>
                <option value="">-- Pilih Kecamatan --</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Kode Pos</label>
            <input name="kode_pos" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Detail Alamat</label>
            <textarea name="detail_alamat" class="form-control" required></textarea>
        </div>

        <button class="btn btn-success">Simpan Alamat</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const provinsi   = document.getElementById('provinsi');
    const kota       = document.getElementById('kota');
    const kecamatan  = document.getElementById('kecamatan');

    // =============================
    // LOAD PROVINSI
    // =============================
    fetch('/api/provinces')
        .then(res => res.json())
        .then(data => {
            data.forEach(item => {
                provinsi.innerHTML += `
                    <option value="${item.name}" data-id="${item.id}">
                        ${item.name}
                    </option>
                `;
            });
        });

    // =============================
    // LOAD KOTA / KABUPATEN
    // =============================
    provinsi.addEventListener('change', function () {
        const idProv = this.options[this.selectedIndex].dataset.id;

        kota.innerHTML = '<option value="">-- Pilih Kota --</option>';
        kecamatan.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';

        fetch(`/api/regencies/${idProv}`)
            .then(res => res.json())
            .then(data => {
                data.forEach(item => {
                    kota.innerHTML += `
                        <option value="${item.name}" data-id="${item.id}">
                            ${item.name}
                        </option>
                    `;
                });
            });
    });

    // =============================
    // LOAD KECAMATAN
    // =============================
    kota.addEventListener('change', function () {
        const idKota = this.options[this.selectedIndex].dataset.id;

        kecamatan.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';

        fetch(`/api/districts/${idKota}`)
            .then(res => res.json())
            .then(data => {
                data.forEach(item => {
                    kecamatan.innerHTML += `
                        <option value="${item.name}">
                            ${item.name}
                        </option>
                    `;
                });
            });
    });

});
</script>
@endpush
