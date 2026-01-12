@extends('layouts.app')

@section('content')

<style>
    /* BUTTON STATUS */
    .btn-status {
        border-radius: 999px;
        padding: 8px 22px;
        border: none;
        background-color: #5cb85c;
        color: white;
        font-weight: 500;
        transition: all .2s ease;
    }

    .btn-status:hover {
        background-color: #4aa84a;
    }

    .btn-status.active {
        background-color: #2f7a2f;
    }

    /* CARD RIWAYAT */
    .riwayat-card {
        border-radius: 14px;
        border: 1px solid #d6ecd6;
        background-color: #ffffff;
    }

    .riwayat-card .title {
        font-weight: 600;
        color: #2f7a2f;
    }

    .riwayat-card .price {
        font-weight: 600;
    }

    .riwayat-wrapper {
        max-width: 700px;
    }

    .table th {
    font-size: 0.85rem;
    color: #2f7a2f;
    }

    .table td {
        font-size: 0.85rem;
    }

    .table thead {
        background-color: #f1f8f1;
    }

</style>

<div class="container my-4 riwayat-wrapper">

    <h4 class="text-success mb-4">Riwayat Transaksi</h4>

    {{-- BUTTON STATUS --}}
    <div class="d-flex gap-2 mb-4">
        <button id="btn-dikemas" class="btn-status active" onclick="showStatus('dikemas')">
            Dikemas
        </button>
        <button id="btn-dikirim" class="btn-status" onclick="showStatus('dikirim')">
            Dikirim
        </button>
        <button id="btn-diterima" class="btn-status" onclick="showStatus('diterima')">
            Diterima
        </button>
    </div>

    @php
        $statusList = ['dikemas', 'dikirim', 'diterima'];
    @endphp

    {{-- RIWAYAT --}}
    @foreach($statusList as $status)
<div id="status-{{ $status }}" 
     class="status-section {{ $status != 'dikemas' ? 'd-none' : '' }}">

    @if(isset($riwayat[$status]) && $riwayat[$status]->count())

        @foreach($riwayat[$status] as $idOrder => $items)

          <div class="card riwayat-card mb-3">
    <div class="card-body">


        <div class="text-muted small mb-3">
            {{ \Carbon\Carbon::parse($items->first()->tanggal_order)->format('d M Y') }}
        </div>

        <div class="table-responsive">
            <table class="table table-sm align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-end">Harga</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->nama_produk }}</td>
                            <td class="text-center">{{ $item->jumlah }}</td>
                            <td class="text-end">
                                Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                            </td>
                            <td class="text-end">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end fw-bold mt-2">
            Total: Rp {{ number_format($items->sum('subtotal'), 0, ',', '.') }}
        </div>

    </div>
</div>
        @endforeach

    @else
        <p class="text-muted">Belum ada transaksi.</p>
    @endif

</div>
@endforeach

</div>

{{-- SCRIPT --}}
<script>
    function showStatus(status) {
        const statuses = ['dikemas', 'dikirim', 'diterima'];

        statuses.forEach(s => {
            document.getElementById('status-' + s).classList.add('d-none');
            document.getElementById('btn-' + s).classList.remove('active');
        });

        document.getElementById('status-' + status).classList.remove('d-none');
        document.getElementById('btn-' + status).classList.add('active');
    }
</script>

@endsection
