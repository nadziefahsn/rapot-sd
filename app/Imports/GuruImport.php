<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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

        $jabatan = $row['jabatan'] ?? '-';
        $nipy = !empty($row['nip']) ? $row['nip'] : (!empty($row['nipy']) ? $row['nipy'] : (!empty($row['nuptk']) ? $row['nuptk'] : '-'));

        $isT2q = Str::contains(strtolower($jabatan), 't2q');
        $targetRole = $isT2q ? 'guru_t2q' : 'guru';

        if ($nipy !== '-') {
            $guruAda = Guru::with('user')->where('nip', $nipy)->first();
            if ($guruAda) {
                $guruAda->update([
                    'nama_guru' => $nama,
                    'jabatan'   => $jabatan !== '-' ? $jabatan : $guruAda->jabatan,
                ]);

                if ($guruAda->user) {
                    $guruAda->user->syncRoles([$targetRole]);
                }

                return null;
            }
        }

        return DB::transaction(function () use ($nama, $jabatan, $nipy, $targetRole) {
            $username = $nipy !== '-' ? $nipy : $nama;

            $user = User::where('email', $username)->first();

            if (!$user) {
                $user = User::create([
                    'name'     => $nama,
                    'email'    => $username,
                    'password' => Hash::make('password123'),
                    'role'     => $targetRole,
                ]);

                $user->assignRole($targetRole);
            } else {
                $user->syncRoles([$targetRole]);
            }

            return new Guru([
                'user_id'   => $user->id,
                'nama_guru' => $nama,
                'jabatan'   => $jabatan,
                'nip'       => $nipy,
            ]);
        });
    }

    public function headingRow(): int
    {
        return 1;
    }
}