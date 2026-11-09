<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatatanT2q extends Model
{
    protected $table = 'catatan_t2qs';

    protected $fillable = [
        'anggota_kelas_id',
        'catatan'
    ];

    public function anggotaKelas()
    {
        return $this->belongsTo(AnggotaKelas::class, 'anggota_kelas_id');
    }
}
