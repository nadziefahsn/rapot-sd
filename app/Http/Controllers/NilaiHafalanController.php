<?php

namespace App\Http\Controllers;

use App\Http\Requests\NilaiHafalanRequest;
use App\Models\NilaiHafalan;
use App\Models\Mapel;
use App\Models\TahunAjaran;
use App\Models\Kelas;
use App\Models\AnggotaKelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NilaiHafalanController extends Controller
{
    private function getGuruLoginId()
    {
        $user = Auth::user();
        return $user->guru_id ?? $user->guru?->id;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guruId = $this->getGuruLoginId();

        $tahunAjaranAktif = TahunAjaran::latest()->first();

        $kelasIds = DB::table('halaqah_siswas')
            ->join('anggota_kelas', 'halaqah_siswas.anggota_kelas_id', '=', 'anggota_kelas.id')
            ->join('kelas', 'anggota_kelas.kelas_id', '=', 'kelas.id')
            ->where('halaqah_siswas.guru_id', $guruId)
            ->when($tahunAjaranAktif, function ($q) use ($tahunAjaranAktif) {
                $q->where('kelas.tahun_ajaran_id', $tahunAjaranAktif->id);
            })
            ->pluck('anggota_kelas.kelas_id')
            ->unique();

        $kelases = Kelas::whereIn('id', $kelasIds)->get();

        foreach ($kelases as $kelas) {
            $sudahDinilai = NilaiHafalan::whereHas('anggotaKelas', function ($q) use ($kelas, $guruId) {
                $q->where('kelas_id', $kelas->id)
                ->whereHas('halaqahSiswas', function ($hq) use ($guruId) {
                    $hq->where('guru_id', $guruId);
                });
            })->exists();

            $kelas->status_penilaian = $sudahDinilai ? 'Sudah Dinilai' : 'Belum Dinilai';
        }

        return view('t2q.nilai_hafalan.index', compact('kelases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NilaiHafalanRequest $request)
    {
        return $this->saveNilai($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kelasId)
    {
        $guruId = $this->getGuruLoginId();
        $kelas = Kelas::findOrFail($kelasId);

        $mapels = Mapel::whereIn('mapel', ['Kata Hikmah', 'Doa Harian', 'Hadits'])
        ->get();

        $siswas = AnggotaKelas::with(['siswa', 'nilaiHafalan'])
            ->where('kelas_id', $kelasId)
            ->whereHas('halaqahSiswas', function ($q) use ($guruId) {
                $q->where('guru_id', $guruId);
            })
            ->get();

        $sudahAdaNilai = NilaiHafalan::whereHas('anggotaKelas', function ($q) use ($kelasId, $guruId) {
            $q->where('kelas_id', $kelasId)
              ->whereHas('halaqahSiswas', function ($hq) use ($guruId) {
                  $hq->where('guru_id', $guruId);
              });
        })->exists();

        return view('t2q.nilai_hafalan.edit', compact('mapels', 'siswas', 'kelas', 'sudahAdaNilai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NilaiHafalanRequest $request, $kelasId)
    {
        return $this->saveNilai($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function saveNilai(NilaiHafalanRequest $request)
    {
        DB::transaction(function () use ($request) {
            foreach ($request->nilai as $anggotaKelasId => $mapelValues) {
                foreach ($mapelValues as $mapelId => $val) {
                    NilaiHafalan::updateOrCreate(
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

        return redirect()->back()->with('success', 'Data Nilai Hafalan berhasil disimpan!');
    }
}
