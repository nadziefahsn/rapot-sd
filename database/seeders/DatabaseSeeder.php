<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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