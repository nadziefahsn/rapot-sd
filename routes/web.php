<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

// 1. Rute Halaman Login (GET untuk tampilkan form, POST untuk proses data)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// 2. Redirect halaman utama langsung ke /login
Route::get('/', function () {
    return redirect('/login');
});

// 3. Rute yang butuh Login (Auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});