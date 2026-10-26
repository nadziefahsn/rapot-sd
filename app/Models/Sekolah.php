<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolahs';

    protected $fillable = [
        'npsn',
        'nama_sekolah',
        'kepala_sekolah',
        'nrks',
        'email',
        'tahun_pelajaran',
        'semester',
    ];
}