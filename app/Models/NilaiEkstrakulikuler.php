<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiEkstrakulikuler extends Model
{
    protected $table= 'nilai_eskuls';
    
    protected $fillable = [
        'ekstrakulikuler_siswa_id',
        'nilai',
    ];

    public function ekstrakulikulerSiswa()
    {
        return $this->belongsTo(EkstrakulikulerSiswa::class, 'ekstrakulikuler_siswa_id');
    }
}
