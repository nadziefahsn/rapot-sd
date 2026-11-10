<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tahfidz extends Model
{
    protected $fillable = [
        'anggota_kelas_id',
        'surah',
        'kekurangan',
        'kelebihan',
        'nilai'
    ];

    protected $casts = [
        'surah'      => 'array',
        'kekurangan' => 'array',
        'kelebihan'  => 'array',
    ];

    public function anggotaKelas()
    {
        return $this->belongsTo(AnggotaKelas::class, 'anggota_kelas_id');
    }
}
