<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EkstrakulikulerSiswa extends Model
{
    protected $table = 'ekstrakulikuler_siswas';
    
    protected $fillable = [
        'ekstrakulikuler_id',
        'anggota_kelas_id',
    ];

    public function ekstrakulikuler()
    {
        return $this->belongsTo(Ekstrakulikuler::class, 'ekstrakulikuler_id');
    }

    public function anggotaKelas()
    {
        return $this->belongsTo(AnggotaKelas::class, 'anggota_kelas_id');
    }
}
