<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiSholat extends Model
{
    protected $guarded = [];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    public function anggotaKelas()
    {
        return $this->belongsTo(AnggotaKelas::class, 'anggota_kelas_id');
    }
}
