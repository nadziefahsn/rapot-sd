<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\SekolahController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\AnggotaKelasController;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/admin/sekolah', SekolahController::class)->except(['create','show','edit','destroy'])->whereNumber('sekolah');
Route::resource('/admin/guru', GuruController::class)->except(['create','show','edit'])->whereNumber('guru');
Route::get('/admin/guru/{id}/edit-password', [GuruController::class, 'editPassword'])->name('guru.edit-password');
Route::put('/admin/guru/{id}/update-password', [GuruController::class, 'updatePassword'])->name('guru.update-password');
Route::put('/admin/guru/{id}/update-user', [GuruController::class, 'updateUser'])->name('guru.update-user');
Route::post('/admin/guru/import', [GuruController::class, 'import'])->name('guru.import');
Route::resource('/admin/tahun_ajaran', TahunAjaranController::class);
Route::post('/admin/kelas/duplicate', [KelasController::class, 'duplicateFromPreviousSemester'])->name('kelas.duplicate');
Route::resource('/admin/kelas', KelasController::class)->parameters([
    'kelas' => 'kelas'
]);
Route::post('/admin/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
Route::get('/admin/siswa/import', function () {
    return redirect()->route('siswa.index');
});
Route::resource('/admin/siswa', SiswaController::class)->except(['show']);
Route::resource('/admin/pengumuman', PengumumanController::class);
Route::resource('/admin/anggota-kelas', AnggotaKelasController::class)->parameters([
            'anggota-kelas' => 'anggotaKelas'
        ]);

