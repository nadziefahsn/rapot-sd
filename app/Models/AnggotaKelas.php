<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\HalaqahSiswa;

class AnggotaKelas extends Model
{
    protected $table = 'anggota_kelas';

    protected $fillable = [
        'nis_id',
        'kelas_id',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis_id', 'nis');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function kehadiran()
    {
        return $this->hasOne(Kehadiran::class, 'anggota_kelas_id');
    }

    public function catatan()
    {
        return $this->hasOne(Catatan::class, 'anggota_kelas_id');
    }

    public function intrakulikuler()
    {
        return $this->hasOne(Intrakulikuler::class, 'anggota_kelas_id');
    }

    public function halaqah()
    {
        return $this->hasOne(HalaqahSiswa::class, 'anggota_kelas_id');
    }

    public function catatanT2q()
    {
        return $this->hasOne(CatatanT2q::class, 'anggota_kelas_id');
    }

    public function nilaiSholat()
    {
        return $this->hasMany(NilaiSholat::class, 'anggota_kelas_id');
    }

    public function halaqahSiswas()
    {
        return $this->hasMany(HalaqahSiswa::class, 'anggota_kelas_id');
    }

    public function nilaiTahsin()
    {
        return $this->hasMany(NilaiTahsin::class, 'anggota_kelas_id');
    }

    public function amalanIbadahs()
    {
        return $this->hasMany(AmalanIbadah::class, 'anggota_kelas_id');
    }

    public function nilaiHafalan()
    {
        return $this->hasMany(NilaiHafalan::class, 'anggota_kelas_id');
    }
}
