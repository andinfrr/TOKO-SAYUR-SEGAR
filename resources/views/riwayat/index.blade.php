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
        <div id="status-{{ $status }}" class="status-section {{ $status != 'dikemas' ? 'd-none' : '' }}">

            @if(isset($riwayat[$status]) && $riwayat[$status]->count())
                @foreach($riwayat[$status] as $item)
                    <div class="card riwayat-card mb-3">
                        <div class="card-body">

                            <div class="title mb-1">
                                {{ $item->nama_produk }}
                            </div>

                            <div class="text-muted small">
                                Jumlah {{ $item->jumlah }} × 
                                Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                            </div>

                            <div class="price mt-1">
                                Total: Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </div>

                            <div class="text-muted small mt-1">
                                {{ \Carbon\Carbon::parse($item->tanggal_order)->format('d M Y') }}
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
