<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\Kelas; 

class AnggotaKelas extends Model
{
    protected $table = 'anggota_kelas';

    protected $fillable = [
        'nis_id',
        'kelas_id',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis_id', 'nis');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function kehadiran()
    {
        return $this->hasOne(Kehadiran::class, 'anggota_kelas_id');
    }

    public function catatan()
    {
        return $this->hasOne(Catatan::class, 'anggota_kelas_id');
    }
}
