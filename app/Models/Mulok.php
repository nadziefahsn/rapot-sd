<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mulok extends Model
{
    protected $table = 'muloks';
    protected $guarded = ['id'];
    protected $fillable = [
        'anggota_kelas_id',
        'mapel_id',
        'nilai_ph',  
        'nilai_npts',  
        'nilai_akhir'
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
