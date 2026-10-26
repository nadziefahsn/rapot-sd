<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\SekolahController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\DashboardController;

// Halaman utama
Route::get('/', function () {
    return redirect('/admin/sekolah');
});

// Autentikasi bawaan
Auth::routes();

// Route Dashboard utama yang mengarah ke Controller
Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');

// Route tambahan untuk AdminLTE (supaya tidak 404 jika manggil /admin/dashboard)
Route::get('/admin/dashboard', [DashboardController::class, 'index']);

// Route untuk Admin (Sekolah & Tahun Ajaran)
Route::resource('/admin/sekolah', SekolahController::class)->except(['create','show','edit','destroy']);
Route::resource('/admin/tahun_ajaran', TahunAjaranController::class);