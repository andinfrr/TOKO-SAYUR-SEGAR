<!DOCTYPE html>
<html>
<head>
    <title>Toko Sayur</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg" style="background:#2e7d32">
  <div class="container">
    <a class="navbar-brand text-white fw-bold" href="/">
      TOKO SAYUR 🥬
    </a>

    <!-- MENU KANAN -->
    <div class="d-flex align-items-center">

        {{-- JIKA PENJUAL --}}
        @if(session()->has('penjual'))
            <span class="text-white fw-bold me-2">Penjual</span>
            <a href="/dashboard" class="btn btn-light btn-sm me-2">
                Dashboard
            </a>
            <a href="/penjual/logout" class="btn btn-danger btn-sm">
                Logout
            </a>

        {{-- JIKA CUSTOMER --}}
        @elseif(session()->has('customer'))
            <span class="text-white fw-bold me-2">
                Halo, {{ session('customer')->nama }}
            </span>
            <a href="/keranjang" class="btn btn-light btn-sm me-2">
                🛒 Keranjang
            </a>
            <a href="/logout" class="btn btn-light btn-sm">
                Logout
            </a>

        {{-- JIKA BELUM LOGIN --}}
        @else
            <a href="/login" class="btn btn-light btn-sm">
                Login
            </a>
        @endif

    </div>
  </div>
</nav>

<div class="container mt-4">

    

    @yield('content')
</div>

</body>
</html>
