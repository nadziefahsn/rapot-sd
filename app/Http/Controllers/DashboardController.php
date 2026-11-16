<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rombel;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\RuangKelas;
use App\Models\Sekolah;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil jumlah data dari database dengan aman
        $totalRombel = class_exists(Rombel::class) ? Rombel::count() : 0;
        $totalSiswa  = class_exists(Siswa::class) ? Siswa::count() : 0;
        $totalGuru   = class_exists(Guru::class) ? Guru::count() : 0;
        $totalRuang  = class_exists(RuangKelas::class) ? RuangKelas::count() : 0;

        // Mengambil data informasi sekolah pertama dari database
        $sekolah = class_exists(Sekolah::class) ? Sekolah::first() : null;

        return view('admin.dashboard', compact(
            'totalRombel', 
            'totalSiswa', 
            'totalGuru', 
            'totalRuang', 
            'sekolah'
        ));
    }
}