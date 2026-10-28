<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intrakulikuler extends Model
{
    protected $table = 'intrakulikulers';

    protected $fillable = [
        'anggota_kelas_id',
        'deskripsi_id',
        'nilai',
    ];

    public function anggota_kelas_id()
    {
        return $this->belongsTo(AnggotaKelas::class, 'anggota_kelas_id');
    }

    public function deskripsi_id()
    {
        return $this->belongsTo(Deskripsi::class, 'deskripsi_id');
    }
}
