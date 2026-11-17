<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKelas;
use App\Models\Intrakulikuler;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class IntrakulikulerController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $guruId = $user->guru?->id;
        $tahunAjaranAktif = TahunAjaran::latest()->first();

        if (!$tahunAjaranAktif || !$guruId) {
            return view('guru.intrakulikulers.index', [
                'anggotaKelas' => collect(),
                'mapels'       => collect(),
                'kelas'        => null,
            ]);
        }

        $kelas = Kelas::where('tahun_ajaran_id', $tahunAjaranAktif->id)
            ->where(function ($query) use ($guruId) {
                $query->where('wali_kelas_id', $guruId)
                      ->orWhere('pendamping_id', $guruId);
            })
            ->first();

        if (!$kelas) {
            return view('guru.intrakulikulers.index', [
                'anggotaKelas' => collect(),
                'mapels'       => collect(),
                'kelas'        => null,
            ]);
        }

        $anggotaKelas = AnggotaKelas::where('kelas_id', $kelas->id)
            ->with(['siswa', 'kelas', 'intrakulikuler'])
            ->get();

        $jenjang = preg_replace('/[^0-9]/', '', $kelas->rombel);

        $kelasSejenjangIds = Kelas::where('tahun_ajaran_id', $tahunAjaranAktif->id)
            ->where('rombel', 'LIKE', $jenjang . '%')
            ->pluck('id');

        $mapels = Mapel::where('kategori', 'Intrakulikuler')
            ->whereHas('deskripsis', function ($q) use ($kelasSejenjangIds) {
                $q->whereIn('kelas_id', $kelasSejenjangIds);
            })
            ->get();

        $sudahAdaNilai = Intrakulikuler::whereHas('anggotaKelas', function ($q) use ($kelas) {
            $q->where('kelas_id', $kelas->id);
        })->exists();

        return view('guru.intrakulikulers.index', compact('kelas', 'anggotaKelas', 'mapels', 'sudahAdaNilai'));
    }

    public function update(Request $request, $kelasId)
    {
        $request->validate([
            'nilai'     => 'nullable|array',
            'nilai.*.*' => 'nullable|numeric|min:0|max:100',
        ]);

        $nilaiData = $request->input('nilai', []);

        foreach ($nilaiData as $anggotaKelasId => $mapelValues) {
            foreach ($mapelValues as $mapelId => $nilaiAngka) {
                if ($nilaiAngka !== null && $nilaiAngka !== '') {
                    Intrakulikuler::updateOrCreate(
                        [
                            'anggota_kelas_id' => $anggotaKelasId,
                            'mapel_id'         => $mapelId,
                        ],
                        [
                            'nilai'            => $nilaiAngka,
                        ]
                    );
                } else {
                    Intrakulikuler::where('anggota_kelas_id', $anggotaKelasId)
                        ->where('mapel_id', $mapelId)
                        ->delete();
                }
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Data nilai intrakulikuler berhasil disimpan!');
    }
}