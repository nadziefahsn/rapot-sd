<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ekstrakulikuler_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ekstrakulikuler_id')->constrained('ekstrakulikulers')->onDelete('cascade');
            $table->foreignId('anggota_kelas_id')->constrained('anggota_kelas')->onDelete('cascade'); // Menghubungkan ke data siswa per kelas
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ekstrakulikuler_siswas');
    }
};
