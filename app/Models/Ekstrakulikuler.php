<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstrakulikuler extends Model
{
    protected $table = 'ekstrakulikulers';

    protected $fillable = [
        'pendamping_id',
        'nama_ekstrakulikuler',
        'tahun_ajaran_id',
    ];

    public function pendamping()
    {
        return $this->belongsTo(Guru::class, 'pendamping_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function anggotaEskul()
    {
        return $this->hasMany(EkstrakulikulerSiswa::class, 'ekstrakulikuler_id');
    }
}
