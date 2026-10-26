<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('sekolahs', function (Blueprint $table) {
        $table->id();
        $table->string('npsn')->default('69956855');
        $table->string('nama_sekolah')->default('SD GIS PRIMA INSANI');
        $table->string('kepala_sekolah')->default('PUJI FAUZIAH, S.Pd.SD.');
        $table->string('nrks')->default('19023L1040211212119042');
        $table->string('email')->default('gis@primainsani.sch.id');
        $table->string('tahun_pelajaran')->default('2025/2026');
        $table->string('semester')->default('Genap');
        $table->timestamps();
    });
}