<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;




// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

// Halaman tentang
Route::get('/tentang', [AboutController::class, 'index'])->name('tentang');

// Halaman kontak
Route::view('/kontak', 'kontak')->name('kontak');

// Proses kirim pesan kontak
Route::post('/kontak', [KontakController::class, 'submit'])->name('kontak.submit');



// Halaman Reservasi
Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');

//login

Route::prefix('admin')->group(function () {
    // Menampilkan form login
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');

    // Proses login (TAMBAHKAN INI!)
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    // Proses logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    });
});

Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});
// Admin Account Management
Route::get('/admin/account', [AdminAuthController::class, 'account'])->name('admin.account');

// Logout
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::post('/admin/password/update', [AdminAuthController::class, 'updatePassword'])->name('admin.password.update');

// Admin user management


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class)->except(['create', 'store', 'show']);
});

