<?php

use App\Http\Controllers\MidtransController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\KontakController;

// Halaman Depan
Route::get('/', function () {
    $produk = \App\Models\Produk::with('kategori')->paginate(3);
    return view('welcome', compact('produk'));
});

// Route Akses Umum (tidak perlu login)
Route::get('/login', [PelangganController::class, 'login_view'])->name('pelanggan.index');
Route::post('/aksi_login', [PelangganController::class, 'login_aksi'])->name('pelanggan.login');
Route::post('/aksi_daftar', [PelangganController::class, 'daftar_aksi'])->name('pelanggan.daftar');
Route::post('/reqpass', [PelangganController::class, 'gantipassword'])->name('pelanggan.reqpass');

// Produk, Tentang Kami, Blog, Kontak — akses publik
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{id}', [ProdukController::class, 'detail'])->name('produk.detail');
Route::get('/tentang-kami', [TentangKamiController::class, 'index'])->name('tentang.index');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [BlogController::class, 'detail'])->name('blog.detail');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');

//cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/tambah/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/hapus/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

//midtrans
Route::get('/midtrans/bayar', [MidtransController::class, 'bayar'])->name('midtrans.bayar');
Route::get('/midtrans/callback', [MidtransController::class, 'handleCallback'])->name('midtrans.callback');


// Group Route yang Wajib Login
Route::middleware(['auth'])->group(function () {
    
    // Profil & Logout
    Route::get('/logout', [PelangganController::class, 'logout'])->name('pelanggan.logout');
    Route::get('/profil/{id}', [PelangganController::class, 'profil'])->name('pelanggan.profil');
    Route::post('/update/{id}', [PelangganController::class, 'update'])->name('profil.update');
    Route::get('/gantipass/{id}', [PelangganController::class, 'gantipass'])->name('pelanggan.gantipass');
    Route::post('/updatepass', [PelangganController::class, 'updatePassword'])->name('pelanggan.updatePassword');

    // Cart
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Order
    Route::get('/dashboard', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/riwayat', [OrderController::class, 'riwayat'])->name('order.riwayat');
    Route::get('/order/{id}', [OrderController::class, 'detail'])->name('order.detail');
    Route::get('/order/sukses', [OrderController::class, 'sukses'])->name('order.success');
});
