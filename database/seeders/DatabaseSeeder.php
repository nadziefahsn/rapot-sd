<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sekolah;
use App\Models\Rombel;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\RuangKelas;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Masukkan profil sekolah default
        Sekolah::create([
            'npsn' => '69956855',
            'nama_sekolah' => 'SD GIS PRIMA INSANI',
            'kepala_sekolah' => 'PUJI FAUZIAH, S.Pd.SD.',
            'nrks' => '19023L1040211212119042',
            'email' => 'gis@primainsani.sch.id',
            'tahun_pelajaran' => '2025/2026',
            'semester' => 'Genap',
        ]);

        // (Opsional) Jika tabel lain belum ada factory-nya, 
        // bagian bawah ini bisa dilewati dulu atau diisi manual nanti.
    }
}