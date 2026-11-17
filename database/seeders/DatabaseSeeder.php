<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sekolah;
use App\Models\Rombel;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\RuangKelas;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Database\Seeders\SekolahSeeder;
use Spatie\Permission\Models\Role;

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

        $this->call(SekolahSeeder::class);

        $roleAdmin   = Role::firstOrCreate(['name' => 'admin']);
        $roleGuru    = Role::firstOrCreate(['name' => 'guru']);
        $roleGuruT2Q = Role::firstOrCreate(['name' => 'guru_t2q']);

        $admin = User::create([
            'name'     => 'Admin Utama',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password123'),

        ]);
        $admin->assignRole($roleAdmin);


        // (Opsional) Jika tabel lain belum ada factory-nya, 
        // bagian bawah ini bisa dilewati dulu atau diisi manual nanti.

        $guru = User::create([
            'name'     => 'Guru Contoh',
            'email'    => 'guru@gmail.com',
            'password' => Hash::make('password123'),
        ]);
        $guru->assignRole($roleGuru);

        $gurut2q = User::create([
            'name'     => 'Guru T2Q Contoh',
            'email'    => 'gurut2q@gmail.com',
            'password' => Hash::make('password123'),
        ]);
        $gurut2q->assignRole($roleGuruT2Q);
    }
}