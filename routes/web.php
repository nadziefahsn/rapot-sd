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
use App\Http\Controllers\MapelController;
use App\Http\Controllers\DeskripsiController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\CatatanController;
use App\Http\Controllers\IntrakulikulerController;
use App\Http\Controllers\GuruT2qController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('admin/pengumuman', PengumumanController::class);
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('pengumuman', PengumumanController::class);
    Route::resource('sekolah', SekolahController::class)->except(['create','show','edit','destroy'])->whereNumber('sekolah');
    Route::resource('tahun_ajaran', TahunAjaranController::class);
    Route::resource('guru', GuruController::class)->except(['create','show','edit'])->whereNumber('guru');
    Route::get('guru/{id}/edit-password', [GuruController::class, 'editPassword'])->name('guru.edit-password');
    Route::put('guru/{id}/update-password', [GuruController::class, 'updatePassword'])->name('guru.update-password');
    Route::put('guru/{id}/update-user', [GuruController::class, 'updateUser'])->name('guru.update-user');
    Route::post('guru/import', [GuruController::class, 'import'])->name('guru.import');
    Route::post('kelas/duplicate', [KelasController::class, 'duplicateFromPreviousSemester'])->name('kelas.duplicate');
    Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas']);
    Route::resource('anggota-kelas', AnggotaKelasController::class)->parameters(['anggota-kelas' => 'anggotaKelas'])->names('admin.anggota-kelas');
    Route::post('siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
    Route::get('siswa/import', function () {
        return redirect()->route('siswa.index');
    });
    Route::resource('siswa', SiswaController::class)->except(['show']);
    Route::resource('mapel', MapelController::class)->except(['show']);
    Route::resource('deskripsi', DeskripsiController::class)->except(['show']);
    Route::post('deskripsi/duplicate', [DeskripsiController::class, 'duplicateFromPreviousSemester'])->name('deskripsi.duplicate');
    Route::resource('guru-t2q', GuruT2qController::class);

    });

Route::middleware(['auth', 'role:guru|guru_t2q'])->prefix('guru')->group(function () {
    Route::resource('anggota-kelas', AnggotaKelasController::class)->parameters(['anggota-kelas' => 'anggotaKelas'])->names('guru.anggota-kelas');
    Route::resource('kehadiran', KehadiranController::class);
    Route::resource('catatan', CatatanController::class);
    Route::resource('intrakulikuler', IntrakulikulerController::class);
});

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');