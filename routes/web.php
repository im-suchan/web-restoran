<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;



// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

// Halaman tentang
Route::get('/tentang', [AboutController::class, 'index'])->name('tentang');


// Proses kirim pesan kontak
Route::post('/kontak', [KontakController::class, 'submit'])->name('kontak.submit');


//login

// ROUTES/WEB.PHP - Update dengan struktur yang sudah ada

Route::prefix('admin')->name('admin.')->group(function () {
    
    // Routes tanpa middleware (public)
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    
    // Google Authentication Routes
    Route::get('/auth/google', [AdminAuthController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('/auth/google/callback', [AdminAuthController::class, 'handleGoogleCallback'])->name('google.callback');

    // Routes dengan middleware auth:admin
    Route::middleware(['auth:admin'])->group(function () {
        
        // Dashboard - INI YANG PENTING
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Account Management
        Route::get('/account', [AdminAuthController::class, 'account'])->name('account');
        Route::post('/password/update', [AdminAuthController::class, 'updatePassword'])->name('password.update');
        
        // Logout
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        // User Management
        Route::resource('users', UserController::class)->except(['create', 'store', 'show']);
    });
});


// Route untuk menu publik
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu/kategori/{kategori}', [MenuController::class, 'kategori'])->name('menu.kategori');

// Route untuk halaman pesan (sesuaikan dengan controller yang ada)
Route::get('/pesan', function() {
    return view('pesan'); // atau sesuai dengan view yang Anda miliki
})->name('pesan');

// Route admin untuk produk
Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    Route::get('produk', [ProductController::class, 'index'])->name('produk.index');
    Route::get('produk/tambah', [ProductController::class, 'create'])->name('produk.create');
    Route::post('produk', [ProductController::class, 'store'])->name('produk.store');
    Route::get('produk/{id}/edit', [ProductController::class, 'edit'])->name('produk.edit');
    Route::put('produk/{id}', [ProductController::class, 'update'])->name('produk.update');
    Route::delete('produk/{id}', [ProductController::class, 'destroy'])->name('produk.destroy');
});

// Route fallback jika diperlukan
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/checkout', [CartController::class, 'prosesCheckout'])->name('checkout.proses');

Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {
    // ... (rute admin lainnya seperti dashboard, users, produk)

    // Rute untuk Manajemen Pesanan
    // Arahkan ke OrderController yang baru, tanpa namespace Admin
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});
Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {
    // ... Rute admin lainnya

    // Tambahkan baris ini untuk rute hapus
    Route::delete('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'destroy'])->name('orders.destroy');
});