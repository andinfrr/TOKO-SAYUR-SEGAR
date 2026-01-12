<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjualAuthController;
use App\Http\Controllers\RiwayatTransaksiController;

// Home & list produk
Route::get('/', [ProdukController::class, 'index']);
Route::get('/produk', [ProdukController::class, 'index']);


// Filter kategori
Route::get('/kategori/{kategori}', [ProdukController::class, 'showKategori']);


// CRUD produk (penjual)
Route::get('/produk/create', [ProdukController::class, 'create']);
Route::post('/produk', [ProdukController::class, 'store']);
Route::get('/produk/{id}/edit', [ProdukController::class, 'edit']);
Route::post('/produk/{id}', [ProdukController::class, 'update']);


Route::get('/keranjang', [KeranjangController::class, 'index']);
// Route::get('/keranjang/tambah/{id_produk}', [KeranjangController::class, 'tambah']);
Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah']);
// Route::get('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus']);
Route::get('/keranjang/kurang/{id}', [KeranjangController::class, 'kurang']);
Route::get('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus']);


// form checkout
Route::get('/checkout', [OrderController::class, 'form']);
// proses checkout (stok dikurangi di sini)
Route::post('/checkout', [OrderController::class, 'proses']);

// login customer
Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);

// register
Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index']);

// invoiceeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
Route::get('/invoice', function () {
    if (!session()->has('invoice')) {
        return redirect('/');
    }

    $invoice = session('invoice');
    return view('invoice.index', [
        'keranjang' => $invoice['items']
    ]);
});

//KATEGORI NIH
Route::get('/', [ProdukController::class, 'index'])->name('produk.index');

Route::get('/kategori/{kategori}', [ProdukController::class, 'kategori'])
    ->name('produk.kategori');


//INI NIH  DAFTAR ORDER MASUK
    Route::put('/order/{id}/status', [OrderController::class, 'updateStatus'])
        ->name('order.updateStatus');

//INI DETAIL ORDER YG MASUK
    Route::get('/order/{id}/detail', [OrderController::class, 'detail'])
        ->name('order.detail');

//RIWAYAT TRANSAKSI
        Route::get('/riwayat-transaksi', [RiwayatTransaksiController::class, 'index'])
        ->name('riwayat.transaksi');
