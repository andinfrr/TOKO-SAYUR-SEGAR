<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\AuthController;


Route::get('/', [ProdukController::class, 'index']);
Route::get('/kategori/{kategori}', [ProdukController::class, 'showKategori']);

Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/create', [ProdukController::class, 'create']);
Route::post('/produk', [ProdukController::class, 'store']);


Route::post('/checkout', [OrderController::class, 'checkout']);

Route::get('/produk/{id}/edit', [ProdukController::class, 'edit']);
Route::post('/produk/{id}', [ProdukController::class, 'update']);

Route::get('/keranjang', [KeranjangController::class, 'index']);
Route::get('/keranjang/tambah/{id_produk}', [KeranjangController::class, 'tambah']);
Route::get('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus']);

Route::get('/checkout', [OrderController::class, 'form']);
Route::post('/checkout', [OrderController::class, 'proses']);

Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index']);

use App\Http\Controllers\PenjualAuthController;

Route::get('/penjual/login', [PenjualAuthController::class, 'loginForm']);
Route::post('/penjual/login', [PenjualAuthController::class, 'login']);
Route::get('/penjual/logout', [PenjualAuthController::class, 'logout']);


Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah']);

