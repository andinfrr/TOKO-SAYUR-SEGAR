<!DOCTYPE html>
<html>
<head>
    <title>Toko Sayur</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FONT -->
     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

</head>
<body>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9f4;
    }

    .navbar-custom {
        background-color: #4caf50;
        border-radius: 40px;
        padding: 12px 30px;
        margin: 20px auto;
        width: 95%;
    }

    .navbar-brand {
        font-weight: 700;
        color: #cfe3b1 !important;
    }

    .nav-link {
        color: #2f5d3a !important;
        font-weight: 500;
        margin-right: 20px;
    }

    .btn-green {
        background-color: #6fa85f;
        color: white;
        border-radius: 30px;
        padding: 6px 18px;
        border: none;
    }

    .btn-green:hover {
        background-color: #5d964f;
        color: white;
    }

    /* KATEGORII CSS */
.kategori-wrapper {
    overflow-x: auto;
}

.kategori-list {
    display: flex;
    gap: 12px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.kategori-item {
    padding: 8px 18px;
    border-radius: 10px;
    background: #f1f7e9;
    color: #2f5d3f;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.kategori-item:hover {
    background: #cfe7c5;
    color: #1e3d2b;
}

.kategori-item.active {
    background: #4caf50;
    color: #fff;
}

    /* CARD PRODUK */
    .product-card {
        border: 1px solid #cfe3b1;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    }

    /* JUDUL PRODUK */
    .product-title {
        color: #2f5d2f;
    }

    /* BUTTON */
    .btn-success {
        background-color: #4caf50;
        border-color: #4caf50;
    }

    .btn-success:hover {
        background-color: #43a047;
        border-color: #43a047;
    }

</style>


<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">

        <!-- LOGO -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('img/sayur.png') }}"
         alt="Logo"
         height="40"
         class="me-2">
        </a>

         @if(session()->has('customer'))
                <span class="fw-semibold text-success text-white ms-2 halo-text ">
                    Halo, {{ session('customer')->nama }}
                </span>
        @endif

    <!-- MENU KANAN -->
    <div class="d-flex align-items-center gap-2 ms-auto">

        @if(session()->has('penjual'))
            <a href="/dashboard" class="btn btn-green btn-sm">Dashboard</a>
            <a href="/penjual/logout" class="btn btn-outline-danger btn-sm rounded-pill">Logout</a>

        @elseif(session()->has('customer'))
            <a href="/keranjang" class="btn btn-green btn-sm">🛒 Keranjang</a>
            <a href="{{ route('riwayat.transaksi') }}" class="btn btn-green btn-sm">Riwayat Transaksi</a>
            <a href="/logout" class="btn btn-outline-danger btn-sm rounded-pill">Logout</a>

        @else
            <a href="/login" class="btn btn-green btn-sm">Login</a>
        @endif

</div>
    </div>
</nav>


<div class="container mt-4">


            @if(session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif

    @yield('content')
</div>

<!-- buat detail -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
