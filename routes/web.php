<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\SekolahController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\PengumumanController;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/admin/sekolah', SekolahController::class)->except(['create','show','edit','destroy'])->whereNumber('sekolah');

Route::resource('/admin/tahun_ajaran', TahunAjaranController::class);
Route::resource('/admin/pengumuman', PengumumanController::class);



