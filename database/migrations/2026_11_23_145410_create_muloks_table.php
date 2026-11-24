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
        Schema::create('muloks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_kelas_id')->constrained()->cascadeOnDelete();
            $table->foreignId('mapel_id')->constrained('mapels')->cascadeOnDelete();
            $table->decimal('nilai_ph', 5, 2)->nullable();    
            $table->decimal('nilai_npts', 5, 2)->nullable();  
            $table->decimal('nilai_akhir', 5, 2)->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muloks');
    }
};