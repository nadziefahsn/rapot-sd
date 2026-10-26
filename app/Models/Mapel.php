<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapels';

    protected $fillable = [
        'kategori',
        'mapel',
        'ringkas',
    ];

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'deskripsis', 'mapel_id', 'kelas_id')
                    ->withPivot('id', 'deskripsi')
                    ->withTimestamps();
    }
}