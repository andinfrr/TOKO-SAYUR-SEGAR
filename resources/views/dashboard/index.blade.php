@extends('layouts.app')

@section('content')
<h3 class="mb-4 text-success">Dashboard Penjual</h3>

{{-- ================= TOTAL ORDER | PENDAPATAN | TAMBAH PRODUK ================= --}}
<div class="row mb-4 align-items-stretch">

    {{-- TOTAL ORDER --}}
    <div class="col-md-4">
        <div class="card text-bg-success h-100">
            <div class="card-body">
                <h5>Total Order</h5>
                <h2>{{ $totalOrder }}</h2>
            </div>
        </div>
    </div>

    {{-- TOTAL PENDAPATAN --}}
    <div class="col-md-4">
        <div class="card text-bg-success h-100">
            <div class="card-body">
                <h5>Total Pendapatan</h5>
                <h2>Rp {{ number_format($totalPendapatan) }}</h2>
            </div>
        </div>
    </div>

    {{-- TAMBAH PRODUK --}}
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

{{-- ================= ORDERAN MASUK ================= --}}
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
                @forelse ($orderMasuk as $o)
                <tr>
                    <td>{{ $o->id_order }}</td>
                    <td>{{ $o->tanggal_order }}</td>
                    <td>{{ $o->nama_customer }}</td>
                    <td>Rp {{ number_format($o->total_harga, 0, ',', '.') }}</td>

                    <td>
                        <span class="badge
                            @if($o->status_order == 'dikemas') bg-warning
                            @elseif($o->status_order == 'dikirim') bg-primary
                            @else bg-success
                            @endif">
                            {{ ucfirst($o->status_order) }}
                        </span>
                    </td>

                    <td>
                        <form action="{{ route('order.updateStatus', $o->id_order) }}" method="POST">
                            @csrf
                            @method('PUT')

                    <button type="button" class="btn btn-outline-success btn-sm mb-1 w-100"onclick="showDetail({{ $o->id_order }})">
                    Detail
                </button>


                            <select name="status_order" class="form-select form-select-sm mb-1">
                                <option value="dikemas" {{ $o->status_order == 'dikemas' ? 'selected' : '' }}>Dikemas</option>
                                <option value="dikirim" {{ $o->status_order == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                <option value="diterima" {{ $o->status_order == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            </select>

                            <button class="btn btn-success btn-sm w-100">
                                Update
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
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

<!-- MODAL DETAIL ORDER -->
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



{{-- ================= PRODUK TERLARIS ================= --}}
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

{{-- ================= KELOLA PRODUK ================= --}}
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
                         style="height:160px;object-fit:cover">

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

                    {{-- TOMBOL EDIT --}}
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
