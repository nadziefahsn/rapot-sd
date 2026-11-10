<?php

namespace App\Http\Controllers;

use App\Http\Requests\TahfidzRequest;
use App\Models\Tahfidz;
use App\Models\TahunAjaran;
use App\Models\AnggotaKelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TahfidzController extends Controller
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
        $tahunAjaranId = $tahunAjaranAktif ? $tahunAjaranAktif->id : null;

        $namaKelasList = DB::table('halaqah_siswas')
            ->join('anggota_kelas', 'halaqah_siswas.anggota_kelas_id', '=', 'anggota_kelas.id')
            ->join('kelas', 'anggota_kelas.kelas_id', '=', 'kelas.id')
            ->where('halaqah_siswas.guru_id', $guruId)
            ->when($tahunAjaranId, function ($q) use ($tahunAjaranId) {
                $q->where('kelas.tahun_ajaran_id', $tahunAjaranId);
            })
            ->pluck('kelas.rombel');

        $tingkatList = $namaKelasList->map(function ($namaKelas) {
            return substr(trim($namaKelas), 0, 1);
        })->filter()->unique()->sort()->values();

        $dataTingkat = [];
        foreach ($tingkatList as $tingkat) {
            $sudahDinilai = Tahfidz::whereHas('anggotaKelas.kelas', function ($q) use ($tingkat, $tahunAjaranId) {
                if ($tahunAjaranId) {
                    $q->where('tahun_ajaran_id', $tahunAjaranId);
                }
                $q->where('rombel', 'like', "{$tingkat}%");
            })->whereHas('anggotaKelas.halaqahSiswas', function ($hq) use ($guruId) {
                $hq->where('guru_id', $guruId);
            })->exists();

            $dataTingkat[] = (object) [
                'tingkat' => $tingkat,
                'status_penilaian' => $sudahDinilai ? 'Sudah Dinilai' : 'Belum Dinilai'
            ];
        }

        return view('t2q.tahfidz.index', compact('dataTingkat'));
    }

    public function create()
    {
        
    }

    public function store(TahfidzRequest $request, $tingkat)
    {
        return $this->saveNilai($request);
    }

    public function show(string $id)
    {
        
    }

    public function edit($tingkat)
    {
        $guruId = $this->getGuruLoginId();

        $tahunAjaranAktif = TahunAjaran::latest()->first();
        $tahunAjaranId = $tahunAjaranAktif ? $tahunAjaranAktif->id : null;

        $siswas = AnggotaKelas::with(['siswa', 'kelas', 'tahfidz'])
            ->whereHas('kelas', function ($q) use ($tingkat, $tahunAjaranId) {
                if ($tahunAjaranId) {
                    $q->where('tahun_ajaran_id', $tahunAjaranId);
                }
                $q->where('rombel', 'like', "{$tingkat}%");
            })
            ->whereHas('halaqahSiswas', function ($q) use ($guruId) {
                $q->where('guru_id', $guruId);
            })
            ->get();

        $sudahAdaNilai = Tahfidz::whereHas('anggotaKelas.kelas', function ($q) use ($tingkat, $tahunAjaranId) {
            if ($tahunAjaranId) {
                $q->where('tahun_ajaran_id', $tahunAjaranId);
            }
            $q->where('rombel', 'like', "{$tingkat}%");
        })->whereHas('anggotaKelas.halaqahSiswas', function ($hq) use ($guruId) {
            $hq->where('guru_id', $guruId);
        })->exists();

        return view('t2q.tahfidz.edit', compact('siswas', 'tingkat', 'sudahAdaNilai'));
    }

    public function update(TahfidzRequest $request, $tingkat)
    {
        return $this->saveNilai($request);
    }

    public function destroy(string $id)
    {
        
    }

    private function saveNilai(TahfidzRequest $request)
    {
        DB::transaction(function () use ($request) {
            $tahfidzInputs = $request->input('nilai', []);

            foreach ($tahfidzInputs as $anggotaKelasId => $data) {
                // Ambil nilai secara aman, pastikan jika kosong/tidak ada diset menjadi 0
                $nilaiVal = 0;
                if (isset($data['nilai']) && $data['nilai'] !== '' && $data['nilai'] !== null) {
                    $nilaiVal = $data['nilai'];
                }

                Tahfidz::updateOrCreate(
                    [
                        'anggota_kelas_id' => $anggotaKelasId,
                    ],
                    [
                        'surah'      => $data['surah'] ?? [],
                        'kekurangan' => $data['kekurangan'] ?? [],
                        'kelebihan'  => $data['kelebihan'] ?? [],
                        'nilai'      => $nilaiVal,
                    ]
                );
            }
        });

        return redirect()->back()->with('success', 'Data Nilai Tahfidz berhasil disimpan!');
    }
}