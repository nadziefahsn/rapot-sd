<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;

class Siswa extends Model
{
    protected $table = 'siswas';
    public $incrementing = false;
    protected $primaryKey = 'nis';
    protected $keyType = 'string';

    protected $fillable = [
        'nis',
        'nisn',
        'nama_siswa',
        'kelas_id',
    ];

    public function getRouteKeyName()
    {
        return 'nis';
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

}