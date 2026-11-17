<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deskripsi extends Model
{
    protected $table = 'deskripsis';

    protected $fillable = [
        'tahun_ajaran_id',
        'kelas_id',
        'mapel_id',
        'deskripsi',
    ];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
}