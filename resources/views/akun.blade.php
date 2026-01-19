@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                <!-- Header -->
                <div class="card-header text-center bg-gradient text-white py-4" style="background:#dfecc8">
                    <h4 class="mb-0 fw-bold">Profil Akun Saya</h4>
                    <small class="opacity-75">Kelola informasi akun Anda</small>
                </div>

                <div class="card-body p-4">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="/akun/update" method="POST">
                        @csrf

                        <!-- DATA PRIBADI -->
                        <h5 class="text-success fw-semibold mb-3 border-bottom pb-2">
                            Data Pribadi
                        </h5>

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama"
                                class="form-control rounded-pill"
                                value="{{ $customer->nama }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email"
                                class="form-control rounded-pill"
                                value="{{ $customer->email }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">No HP</label>
                            <input type="text" name="no_hp"
                                class="form-control rounded-pill"
                                value="{{ $customer->no_hp }}">
                        </div>

                        <!-- ALAMAT -->
                        <h5 class="text-success fw-semibold mb-3 border-bottom pb-2">
                            Alamat Utama
                        </h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Provinsi</label>
                                <input type="text" name="provinsi"
                                    class="form-control rounded-pill"
                                    value="{{ $alamat->provinsi ?? '' }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kota</label>
                                <input type="text" name="kota"
                                    class="form-control rounded-pill"
                                    value="{{ $alamat->kota ?? '' }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kecamatan</label>
                                <input type="text" name="kecamatan"
                                    class="form-control rounded-pill"
                                    value="{{ $alamat->kecamatan ?? '' }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kode Pos</label>
                                <input type="text" name="kode_pos"
                                    class="form-control rounded-pill"
                                    value="{{ $alamat->kode_pos ?? '' }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Detail Alamat</label>
                            <textarea name="detail_alamat"
                                class="form-control rounded-4"
                                rows="3">{{ $alamat->detail_alamat ?? '' }}</textarea>
                        </div>

                        <!-- BUTTON -->
                        <button class="btn btn-success w-100 rounded-pill py-2 fw-semibold">
                            Simpan Perubahan
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
