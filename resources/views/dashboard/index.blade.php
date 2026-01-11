@extends('layouts.app')

@section('content')

 <!-- ================= STYLE DASHBOARD =================
semua CSS buat dashboard penjual, biar tampilannya rapi, dan konsisten warna hijau. -->

<style>
    /* ================= GLOBAL ================= */
    /* Styling judul */
    h3 {
        font-weight: 700;
        color: #2f5d3a;
    }

    /* ================= CARD SUMMARY ================= */
    /* card total order & pendapatan */
    .card.text-bg-success {
        background: linear-gradient(135deg, #4caf50, #6fa85f);
        border-radius: 18px;
        box-shadow: 0 10px 25px rgba(47,93,58,0.2);
    }

    /* card tambah produk */
    .card.border-success {
        border-radius: 18px;
        border: 2px dashed #6fa85f;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .card.border-success:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 22px rgba(0,0,0,.15);
    }

    /* ================= TABLE ORDER ================= */
    /* Table order masuk */
    .table {
        border-radius: 12px;
        overflow: hidden;
    }

    .table thead th {
        background: #f1f7e9;
        color: #2f5d3a;
        font-weight: 600;
    }

    .table tbody tr:hover {
        background: #f8f9f4;
    }

    /* ================= STATUS BADGE ================= */
    /* Badge status order */
    .badge {
        padding: 6px 12px;
        border-radius: 12px;
        font-weight: 500;
    }

    .bg-warning {
        background-color: #ffb300 !important;
    }

    .bg-primary {
        background-color: #42a5f5 !important;
    }

    .bg-success {
        background-color: #4caf50 !important;
    }

    /* ================= BUTTON ================= */
    .btn-success {
        background-color: #4caf50;
        border-color: #4caf50;
        border-radius: 30px;
    }

    .btn-success:hover {
        background-color: #43a047;
        border-color: #43a047;
    }

    .btn-outline-success {
        border-radius: 30px;
        font-weight: 500;
    }

    .btn-outline-success:hover {
        background: #4caf50;
        color: #fff;
    }

    /* ================= MODAL ================= */
    /* Modal detail order */
    .modal-content {
        border-radius: 20px;
    }

    .modal-header {
        background: #dfecc8;
        color: #2f5d3a;
        border-bottom: none;
    }

    /* ================= PRODUK CARD ================= */
    /* Card produk di kelola produk */
    .card.h-100 {
        border-radius: 16px;
        overflow: hidden;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .card.h-100:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 30px rgba(47,93,58,.18);
    }

    .card-img-top {
        border-bottom: 1px solid #e6f1d9;
    }

    /* ================= LIST TERLARIS ================= */
    .list-group-item {
        border-radius: 12px;
        margin-bottom: 6px;
        border: 1px solid #cfe7c5;
        transition: background .2s;
    }

    .list-group-item:hover {
        background: #f1f7e9;
    }

    /* ================= FORM ================= */
    .form-select,
    .form-control {
        border-radius: 12px;
        border: 1px solid #cfe7c5;
    }

    .form-select:focus,
    .form-control:focus {
        border-color: #6fa85f;
        box-shadow: 0 0 0 .2rem rgba(111,168,95,.25);
    }

    /* ================= RESPONSIVE ================= */
    @media (max-width: 768px) {
        h3 {
            text-align: center;
        }

        .card.text-bg-success h2 {
            font-size: 28px;
        }
    }
</style>

<h3 class="mb-4 text-success">Dashboard Penjual</h3>

 <!-- ================= RINGKASAN DATA =================
Total order, total pendapatan, dan tombol tambah produk -->

<div class="row mb-4 align-items-stretch">

    <!-- total order -->
    <div class="col-md-4">
        <div class="card text-bg-success h-100">
            <div class="card-body">
                <h5>Total Order</h5>
                <h2>{{ $totalOrder }}</h2>
            </div>
        </div>
    </div>

    <!-- total pendapatan -->
    <div class="col-md-4">
        <div class="card text-bg-success h-100">
            <div class="card-body">
                <h5>Total Pendapatan</h5>
                <h2>Rp {{ number_format($totalPendapatan) }}</h2>
            </div>
        </div>
    </div>

    {{-- TOMBOL TAMBAH PRODUK --}}
    <div class="col-md-4">
        <div class="card border-success h-100">
            <div class="card-body d-flex flex-column justify-content-center">
                <a href="{{ url('/produk/create') }}"
                   class="btn btn-success btn-lg w-100">
                    + Tambah Produk
                </a>
            </div>
        </div>
    </div>

</div>

 <!-- ================= ORDERAN MASUK =================
List semua order yang masuk ke penjual -->

<div class="card mb-4">
    <div class="card-header bg-success text-white">
        Orderan Masuk
    </div>

    <div class="card-body p-0">
        <table class="table table-bordered table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>

            <tbody>
                {{-- LOOP DATA ORDER --}}
                @forelse ($orderMasuk as $o)
                <tr>
                    <td>{{ $o->id_order }}</td>
                    <td>{{ $o->tanggal_order }}</td>
                    <td>{{ $o->nama_customer }}</td>
                    <td>Rp {{ number_format($o->total_harga, 0, ',', '.') }}</td>

                    {{-- STATUS ORDER --}}
                    <td>
                        <span class="badge
                            @if($o->status_order == 'dikemas') bg-warning
                            @elseif($o->status_order == 'dikirim') bg-primary
                            @else bg-success
                            @endif">
                            {{ ucfirst($o->status_order) }}
                        </span>
                    </td>

                    {{-- AKSI --}}
                    <td>
                        <form action="{{ route('order.updateStatus', $o->id_order) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Tombol detail order --}}
                            <button type="button"
                                class="btn btn-outline-success btn-sm mb-1 w-100"
                                onclick="showDetail('{{ $o->id_order }}')">
                                Detail
                            </button>

                            {{-- Dropdown update status --}}
                            <select name="status_order" class="form-select form-select-sm mb-1">
                                <option value="dikemas" {{ $o->status_order == 'dikemas' ? 'selected' : '' }}>Dikemas</option>
                                <option value="dikirim" {{ $o->status_order == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                <option value="diterima" {{ $o->status_order == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            </select>

                            {{-- Tombol update status --}}
                            <button class="btn btn-success btn-sm w-100">
                                Update
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                {{-- Kalo belum ada order --}}
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Belum ada order masuk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

 <!-- ================= MODAL DETAIL ORDER =================
Muncul pas tombol "Detail" ditekan -->

<div class="modal fade" id="modalDetailOrder" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Detail Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody id="detailProduk"></tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<!-- ================= PRODUK TERLARIS ================= -->
<div class="card mb-4">
    <div class="card-header bg-success text-white">
        Produk Terlaris
    </div>
    <div class="card-body">
        <ul class="list-group">
            @foreach($produkTerlaris as $p)
            <li class="list-group-item d-flex justify-content-between">
                {{ $p->nama_produk }}
                <span class="badge bg-success">{{ $p->total_jual }}</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>

 <!-- ================= KELOLA PRODUK =================  -->
<div class="card mt-4">
    <div class="card-header bg-success text-white">
        Kelola Produk
    </div>

    <div class="card-body">
        <div class="row">
            @foreach($produk as $p)
            <div class="col-md-3 mb-4">
                <div class="card h-100">

                    {{-- FOTO PRODUK --}}
                    <img src="{{ asset('storage/'.$p->foto) }}"
                         class="card-img-top"
                         style="height:200px;object-fit:cover">

                    {{-- INFO PRODUK --}}
                    <div class="card-body">
                        <h6 class="fw-bold">{{ $p->nama_produk }}</h6>

                        <p class="mb-1 text-success">
                            Rp {{ number_format($p->harga) }}
                        </p>

                        <small class="text-muted">
                            Stok: {{ $p->stok }}
                        </small>
                    </div>

                    {{-- TOMBOL EDIT PRODUK --}}
                    <div class="card-footer bg-white border-0">
                        <a href="{{ url('/produk/'.$p->id_produk.'/edit') }}"
                           class="btn btn-success btn-sm w-100">
                            Edit Produk
                        </a>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- {{-- ================= SCRIPT DETAIL ORDER =================
Ambil detail order pake fetch,
terus tampilin ke modal
--}} -->
<script>
function showDetail(id) {
    fetch(`/order/${id}/detail`)
        .then(res => res.json())
        .then(data => {
            let html = '';
            let total = 0;

            data.forEach(item => {
                total += Number(item.subtotal);
                html += `
                    <tr>
                        <td>${item.nama_produk}</td>
                        <td>${item.jumlah}</td>
                        <td>Rp ${Number(item.harga_satuan).toLocaleString('id-ID')}</td>
                        <td>Rp ${Number(item.subtotal).toLocaleString('id-ID')}</td>
                    </tr>
                `;
            });

            html += `
                <tr class="fw-bold">
                    <td colspan="3" class="text-end">Total</td>
                    <td>Rp ${total.toLocaleString('id-ID')}</td>
                </tr>
            `;

            document.getElementById('detailProduk').innerHTML = html;
            new bootstrap.Modal(document.getElementById('modalDetailOrder')).show();
        });
}
</script>

@endsection
