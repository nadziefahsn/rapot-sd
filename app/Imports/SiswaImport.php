<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\AnggotaKelas;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection
{

    public function collection(Collection $collection): void
    {
        foreach ($collection as $index => $row) {
            $colA = isset($row[0]) ? trim((string)$row[0]) : '';
            $colB = isset($row[1]) ? trim((string)$row[1]) : '';
            $colC = isset($row[2]) ? trim((string)$row[2]) : '';
            $colD = isset($row[3]) ? trim((string)$row[3]) : '';

            $nis = null;
            $nisn = '-';
            $nama_siswa = '';

            if (is_numeric($colA) && !empty($colA)) {
                $nis = $colA;
                $nisn = !empty($colB) ? $colB : '-';
                $nama_siswa = !empty($colC) ? $colC : $colD;
            } 
            elseif (is_numeric($colB) && !empty($colB)) {
                $nis = $colB;
                $nisn = !empty($colC) ? $colC : '-';
                $nama_siswa = $colD;
            }

            $nama_lower = strtolower($nama_siswa);
            if (
                empty($nis) || 
                empty($nama_siswa) || 
                $nama_siswa === '-' || 
                $nama_lower === 'nama' || 
                $nama_lower === 'nama siswa'
            ) {
                continue;
            }

            $siswa = Siswa::updateOrCreate(
                ['nis' => $nis],
                [
                    'nisn'       => $nisn,
                    'nama_siswa' => $nama_siswa,
                ]
            );

            AnggotaKelas::firstOrCreate([
                'nis_id' => $siswa->nis, 
            ]);
        }
    }
}