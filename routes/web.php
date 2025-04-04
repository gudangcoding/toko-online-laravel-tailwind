<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $produk = \App\Models\Produk::with('kategori')->paginate(3);
    return view('welcome',compact('produk'));
});

use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\KontakController;

// Route Pelanggan
Route::get('/login', [PelangganController::class, 'login_view'])->name('pelanggan.index');
Route::get('/logout', [PelangganController::class, 'logout'])->name('pelanggan.logout');
Route::post('/aksi_login', [PelangganController::class, 'login_aksi'])->name('pelanggan.login');
Route::post('/aksi_daftar', [PelangganController::class, 'daftar_aksi'])->name('pelanggan.daftar');
Route::get('/prodil/{id}', [PelangganController::class, 'profil'])->name('pelanggan.profil');
Route::get('/gantipass/{id}', [PelangganController::class, 'gantipassword'])->name('pelanggan.gantipass');
Route::get('/reqpass', [PelangganController::class, 'gantipassword'])->name('pelanggan.reqpass');

// Route Produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{id}', [ProdukController::class, 'detail'])->name('produk.detail');

// Route Tentang Kami
Route::get('/tentang-kami', [TentangKamiController::class, 'index'])->name('tentang.index');

// Route Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [BlogController::class, 'detail'])->name('blog.detail');

// Route Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');

// Route Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/tambah/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/hapus/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');


//order
Route::get('/dashboard', [OrderController::class, 'index'])->name('order.index');
Route::get('/order/riwayat', [OrderController::class, 'index'])->name('order.riwayat');
Route::get('/order/detail/{id}', [OrderController::class, 'index'])->name('order.detail');
Route::get('/order/sukses', [OrderController::class, 'sukses'])->name('order.success');
