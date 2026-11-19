<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKelas;
use App\Models\Mulok;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class MulokController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $guruId = $user->guru?->id;
        $tahunAjaranAktif = TahunAjaran::latest()->first();

        if (!$tahunAjaranAktif || !$guruId) {
            return view('guru.muloks.index', [
                'anggotaKelas' => collect(),
                'mapels' => collect(),
                'kelas' => null,
                'sudahAdaNilai' => false,
            ]);
        }

        $kelas = Kelas::where('tahun_ajaran_id', $tahunAjaranAktif->id)
            ->where(function ($query) use ($guruId) {
                $query->where('wali_kelas_id', $guruId)
                    ->orWhere('pendamping_id', $guruId);
            })
            ->first();

        if (!$kelas) {
            return view('guru.muloks.index', [
                'anggotaKelas' => collect(),
                'mapels' => collect(),
                'kelas' => null,
                'sudahAdaNilai' => false,
            ]);
        }

        $anggotaKelas = AnggotaKelas::where('kelas_id', $kelas->id)
            ->with(['siswa', 'kelas', 'mulok'])
            ->get();

        $jenjang = preg_replace('/[^0-9]/', '', $kelas->rombel);

        $kelasSejenjangIds = Kelas::where('rombel', 'LIKE', '%' . $jenjang . '%')
            ->pluck('id');

        $mapels = Mapel::where('kategori', 'KO Kulikuler dan Extrakulikuler')
            ->whereHas('deskripsis', function ($q) use ($kelasSejenjangIds) {
                $q->whereIn('kelas_id', $kelasSejenjangIds);
            })
            ->get();

        $sudahAdaNilai = Mulok::whereHas('anggotaKelas', function ($q) use ($kelas) {
            $q->where('kelas_id', $kelas->id);
        })->exists();

        return view('guru.muloks.index', compact(
            'kelas',
            'anggotaKelas',
            'mapels',
            'sudahAdaNilai'
        ));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id)
    {
        
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nilai' => 'nullable|array',
            'nilai.*.*' => 'nullable|numeric|min:0|max:100',
        ]);

        $nilaiData = $request->input('nilai', []);

        foreach ($nilaiData as $anggotaKelasId => $mapelValues) {
            foreach ($mapelValues as $mapelId => $nilaiAngka) {
                if ($nilaiAngka !== null && $nilaiAngka !== '') {
                    Mulok::updateOrCreate(
                        [
                            'anggota_kelas_id' => $anggotaKelasId,
                            'mapel_id' => $mapelId,
                        ],
                        [
                            'nilai' => $nilaiAngka,
                        ]
                    );
                } else {
                    Mulok::where('anggota_kelas_id', $anggotaKelasId)
                        ->where('mapel_id', $mapelId)
                        ->delete();
                }
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Data nilai Mulok berhasil disimpan!');
    }

    public function destroy(string $id)
    {
        
    }
}
