<?php

namespace App\Http\Controllers;

use App\Http\Requests\AmalanIbadahRequest;
use App\Models\AmalanIbadah;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\AnggotaKelas;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AmalanIbadahController extends Controller
{
    private function getGuruLoginId()
    {
        $user = Auth::user();
        return $user->guru_id ?? $user->guru?->id;
    }

    public function index()
    {
        $guruId = $this->getGuruLoginId();

        $tahunAjaranAktif = TahunAjaran::latest()->first();

        $namaKelasList = DB::table('halaqah_siswas')
            ->join('anggota_kelas', 'halaqah_siswas.anggota_kelas_id', '=', 'anggota_kelas.id')
            ->join('kelas', 'anggota_kelas.kelas_id', '=', 'kelas.id')
            ->where('halaqah_siswas.guru_id', $guruId)
            ->pluck('kelas.rombel');

        $tingkatList = $namaKelasList->map(function ($namaKelas) {
            return substr(trim($namaKelas), 0, 1);
        })->filter()->unique()->sort()->values();

        $dataTingkat = [];
        foreach ($tingkatList as $tingkat) {
            $sudahDinilai = AmalanIbadah::whereHas('anggotaKelas.kelas', function ($q) use ($tingkat) {
                $q->where('rombel', 'like', "{$tingkat}%");
            })->whereHas('anggotaKelas.halaqahSiswas', function ($hq) use ($guruId) {
                $hq->where('guru_id', $guruId);
            })->exists();

            $dataTingkat[] = (object) [
                'tingkat' => $tingkat,
                'status_penilaian' => $sudahDinilai ? 'Sudah Dinilai' : 'Belum Dinilai'
            ];
        }

        return view('t2q.amalan_ibadahs.index', compact('dataTingkat'));
    }

    public function edit($tingkat)
    {
        $guruId = $this->getGuruLoginId();

        $mapels = Mapel::where('kategori', 'Amal Ibadah')->get();

        $siswas = AnggotaKelas::with(['siswa', 'kelas', 'amalanIbadahs'])
            ->whereHas('kelas', function ($q) use ($tingkat) {
                $q->where('rombel', 'like', "{$tingkat}%");
            })
            ->whereHas('halaqahSiswas', function ($q) use ($guruId) {
                $q->where('guru_id', $guruId);
            })
            ->get();

        $sudahAdaNilai = AmalanIbadah::whereHas('anggotaKelas.kelas', function ($q) use ($tingkat) {
            $q->where('rombel', 'like', "{$tingkat}%");
        })->whereHas('anggotaKelas.halaqahSiswas', function ($hq) use ($guruId) {
            $hq->where('guru_id', $guruId);
        })->exists();

        return view('t2q.amalan_ibadahs.edit', compact('mapels', 'siswas', 'tingkat', 'sudahAdaNilai'));
    }

    public function store(AmalanIbadahRequest $request, $tingkat)
    {
        return $this->saveNilai($request);
    }

    public function update(AmalanIbadahRequest $request, $tingkat)
    {
        return $this->saveNilai($request);
    }

    private function saveNilai(AmalanIbadahRequest $request)
    {
        DB::transaction(function () use ($request) {
            foreach ($request->nilai as $anggotaKelasId => $mapelValues) {
                foreach ($mapelValues as $mapelId => $val) {
                    AmalanIbadah::updateOrCreate(
                        [
                            'anggota_kelas_id' => $anggotaKelasId,
                            'mapel_id'         => $mapelId,
                        ],
                        [
                            'nilai' => ($val !== '' && $val !== null) ? $val : null,
                        ]
                    );
                }
            }
        });

        return redirect()->back()->with('success', 'Data Nilai Amalan Ibadah berhasil disimpan!');
    }
}