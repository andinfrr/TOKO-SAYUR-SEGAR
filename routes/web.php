<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjualAuthController;
use App\Http\Controllers\RiwayatTransaksiController;


/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA & PRODUK (CUSTOMER)
|--------------------------------------------------------------------------
*/

// Home & list produk
Route::get('/', [ProdukController::class, 'index']);
Route::get('/produk', [ProdukController::class, 'index']);

// Filter kategori
Route::get('/kategori/{kategori}', [ProdukController::class, 'showKategori']);


/*
|--------------------------------------------------------------------------
| PRODUK (PENJUAL)
|--------------------------------------------------------------------------
*/

// CRUD produk (penjual)
Route::get('/produk/create', [ProdukController::class, 'create']);
Route::post('/produk', [ProdukController::class, 'store']);

Route::get('/produk/{id}/edit', [ProdukController::class, 'edit']);
Route::post('/produk/{id}', [ProdukController::class, 'update']);


/*
|--------------------------------------------------------------------------
| KERANJANG (CUSTOMER)
|--------------------------------------------------------------------------
*/

Route::get('/keranjang', [KeranjangController::class, 'index']);

// Route::get('/keranjang/tambah/{id_produk}', [KeranjangController::class, 'tambah']);
Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah']);

// Route::get('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus']);


Route::get('/keranjang/kurang/{id}', [KeranjangController::class, 'kurang']);
Route::get('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus']);


/*
|--------------------------------------------------------------------------
| CHECKOUT & ORDER
|--------------------------------------------------------------------------
*/

// form checkout
Route::get('/checkout', [OrderController::class, 'form']);

// proses checkout (stok dikurangi di sini)
Route::post('/checkout', [OrderController::class, 'proses']);


/*
|--------------------------------------------------------------------------
| AUTH CUSTOMER
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);


/*
|--------------------------------------------------------------------------
| AUTH PENJUAL
|--------------------------------------------------------------------------
*/

Route::get('/penjual/login', [PenjualAuthController::class, 'loginForm']);
Route::post('/penjual/login', [PenjualAuthController::class, 'login']);
Route::get('/penjual/logout', [PenjualAuthController::class, 'logout']);


/*
|--------------------------------------------------------------------------
| DASHBOARD PENJUAL
|--------------------------------------------------------------------------
*/


// Route::get('/keranjang/kurang/{id}', [KeranjangController::class, 'kurang']);
// Route::get('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus']);

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



//anu loginnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn



// Route::post('/keranjang/tambah', function (\Illuminate\Http\Request $request) {
//     // cek login customer
//     if (!session()->has('customer')) {
//         return redirect('/login')->with('error', 'Silahkan login terlebih dulu.');
//     }

//     // ambil keranjang dari session, default kosong
//     $keranjang = session()->get('keranjang', []);

//     // tambah produk baru ke keranjang
//     $produk = [
//         'id_keranjang_detail' => rand(1,1000), // id unik sementara
//         'nama_produk' => $request->nama_produk,
//         'harga' => $request->harga,
//         'jumlah' => $request->jumlah
//     ];

//     $keranjang[] = $produk;

//     // simpan kembali ke session
//     session(['keranjang' => $keranjang]);

//     // redirect ke halaman keranjang (GET /keranjang)
//     return redirect('/keranjang')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
// });

    //INI NIH ORDER
Route::put('/order/{id}/status', [OrderController::class, 'updateStatus'])
    ->name('order.updateStatus');

//INI DETAIL ORDER
Route::get('/order/{id}/detail', [OrderController::class, 'detail'])
    ->name('order.detail');

    //RIWAYAT TRANSAKSI
    Route::get('/riwayat-transaksi', [RiwayatTransaksiController::class, 'index'])
    ->name('riwayat.transaksi');
