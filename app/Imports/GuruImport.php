<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * @return Model|array|null
     */
    public function model(array $row): Model|array|null
    {
        $nama = $row['nama_guru'] ?? $row['nama'] ?? null;

        if (empty($nama)) {
            return null;
        }

        $nipy = !empty($row['nip']) ? $row['nip'] : (!empty($row['nipy']) ? $row['nipy'] : (!empty($row['nuptk']) ? $row['nuptk'] : '-'));

        if ($nipy !== '-') {
            $guruAda = Guru::where('nip', $nipy)->first();
            if ($guruAda) {
                $guruAda->update([
                    'nama_guru' => $nama,
                    'jabatan'   => $row['jabatan'] ?? $guruAda->jabatan,
                ]);
                return null;
            }
        }

        return DB::transaction(function () use ($row, $nama, $nipy) {
            $username = $nipy !== '-' ? $nipy : $nama;

            $user = User::where('email', $username)->first();

            if (!$user) {
                $user = User::create([
                    'name'     => $nama,
                    'email'    => $username,
                    'password' => Hash::make('password123'),
                ]);

                if (method_exists($user, 'assignRole')) {
                    $user->assignRole('guru');
                }
            }

            return new Guru([
                'user_id'   => $user->id,
                'nama_guru' => $nama,
                'jabatan'   => $row['jabatan'] ?? '-',
                'nip'       => $nipy,
            ]);
        });
    }

    public function headingRow(): int
    {
        return 1;
    }
}