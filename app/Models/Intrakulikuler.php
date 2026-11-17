<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intrakulikuler extends Model
{
    protected $table = 'intrakulikulers';

    protected $fillable = [
        'anggota_kelas_id',
        'mapel_id',
        'nilai',
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
