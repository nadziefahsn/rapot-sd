<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah; // Pastikan model ini ada

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data pertama dari tabel sekolah di database
        $sekolahData = Sekolah::first();

        return view('dashboard', [
            'rombel'         => $sekolahData->rombel ?? 0,
            'peserta_didik'  => $sekolahData->peserta_didik ?? 0,
            'guru_tendik'    => $sekolahData->guru_tendik ?? 0,
            'ruang_kelas'    => $sekolahData->ruang_kelas ?? 0,
            'npsn'           => $sekolahData->npsn ?? '-',
            'sekolah'        => $sekolahData->nama_sekolah ?? 'SD GIS PRIMA INSANI',
            'kepsek'         => $sekolahData->kepala_sekolah ?? '-',
            'nrks'           => $sekolahData->nrks ?? '-',
            'email'          => $sekolahData->email ?? '-',
        ]);
    }
}