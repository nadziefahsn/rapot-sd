<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiTahsin extends Model
{
    use HasFactory;

    protected $fillable = [
        'anggota_kelas_id',
        'mapel_id',
        'jilid',
        'halaman',
        'nilai',
        'kekurangan',
        'kelebihan',
    ];

    protected $casts = [
        'kekurangan' => 'array',
        'kelebihan'  => 'array',
    ];

    public function anggotaKelas()
    {
        return $this->belongsTo(AnggotaKelas::class, 'anggota_kelas_id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
}