<?php

namespace App\Http\Controllers;

use App\Http\Requests\NilaiSholatRequest;
use App\Models\NilaiSholat;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\AnggotaKelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NilaiSholatController extends Controller
{
    private function getGuruLoginId()
    {
        $user = Auth::user();
        return $user->guru_id ?? $user->guru?->id;
    }

    public function index()
    {
        $guruId = $this->getGuruLoginId();

        $kelasIds = DB::table('halaqah_siswas')
            ->join('anggota_kelas', 'halaqah_siswas.anggota_kelas_id', '=', 'anggota_kelas.id')
            ->where('halaqah_siswas.guru_id', $guruId)
            ->pluck('anggota_kelas.kelas_id')
            ->unique();

        $kelases = Kelas::whereIn('id', $kelasIds)->get();

        foreach ($kelases as $kelas) {
            $sudahDinilai = NilaiSholat::whereHas('anggotaKelas', function ($q) use ($kelas, $guruId) {
                $q->where('kelas_id', $kelas->id)
                  ->whereHas('halaqahSiswas', function ($hq) use ($guruId) {
                      $hq->where('guru_id', $guruId);
                  });
            })->exists();

            $kelas->status_penilaian = $sudahDinilai ? 'Sudah Dinilai' : 'Belum Dinilai';
        }

        return view('t2q.nilai_sholat.index', compact('kelases'));
    }

    public function edit($kelasId)
    {
        $guruId = $this->getGuruLoginId();
        $kelas = Kelas::findOrFail($kelasId);

        $mapels = Mapel::where('kategori', 'Mulok PAI Khas Prima Insani')->get();

        $siswas = AnggotaKelas::with(['siswa', 'nilaiSholat'])
            ->where('kelas_id', $kelasId)
            ->whereHas('halaqahSiswas', function ($q) use ($guruId) {
                $q->where('guru_id', $guruId);
            })
            ->get();

        $sudahAdaNilai = NilaiSholat::whereHas('anggotaKelas', function ($q) use ($kelasId, $guruId) {
            $q->where('kelas_id', $kelasId)
              ->whereHas('halaqahSiswas', function ($hq) use ($guruId) {
                  $hq->where('guru_id', $guruId);
              });
        })->exists();

        return view('t2q.nilai_sholat.edit', compact('mapels', 'siswas', 'kelas', 'sudahAdaNilai'));
    }

    public function store(NilaiSholatRequest $request, $kelasId)
    {
        return $this->saveNilai($request);
    }

    public function update(NilaiSholatRequest $request, $kelasId)
    {
        return $this->saveNilai($request);
    }

    private function saveNilai(NilaiSholatRequest $request)
    {
        DB::transaction(function () use ($request) {
            foreach ($request->nilai as $anggotaKelasId => $mapelValues) {
                foreach ($mapelValues as $mapelId => $val) {
                    NilaiSholat::updateOrCreate(
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

        return redirect()->back()->with('success', 'Data Nilai Sholat berhasil disimpan!');
    }
}