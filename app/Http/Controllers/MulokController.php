<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKelas;
use App\Models\Mulok;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\TahunAjaran;
use App\Http\Requests\MulokRequest;
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
                'kelas' => null,
                'mapels' => collect(),
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
                'kelas' => null,
                'mapels' => collect(),
            ]);
        }

        $jumlahSiswa = AnggotaKelas::where('kelas_id', $kelas->id)->count();

        $jenjang = preg_replace('/[^0-9]/', '', $kelas->rombel);
        $kelasSejenjangIds = Kelas::where('rombel', 'LIKE', '%' . $jenjang . '%')->pluck('id');

        $mapels = Mapel::where('kategori', 'KO Kulikuler dan Extrakulikuler')
            ->whereHas('deskripsis', function ($q) use ($kelasSejenjangIds) {
                $q->whereIn('kelas_id', $kelasSejenjangIds);
            })
            ->get()
            ->map(function ($mapel) use ($kelas, $jumlahSiswa) {
                $mapel->rencana_penilaian = $jumlahSiswa;

                $mapel->telah_dinilai = Mulok::where('mapel_id', $mapel->id)
                    ->whereHas('anggotaKelas', function ($q) use ($kelas) {
                        $q->where('kelas_id', $kelas->id);
                    })
                    ->where(function($query) {
                        $query->whereNotNull('nilai_ph')
                              ->orWhereNotNull('nilai_npts');
                    })
                    ->count();

                return $mapel;
            });

        return view('guru.muloks.index', compact(
            'kelas',
            'mapels'
        ));
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show(string $id) {
        //
    }

    public function edit(string $id)
    {
        $mapel = Mapel::findOrFail($id);
        
        $user = auth()->user();
        $guruId = $user->guru?->id;
        $tahunAjaranAktif = TahunAjaran::latest()->first();

        $kelas = Kelas::where('tahun_ajaran_id', $tahunAjaranAktif->id)
            ->where(function ($query) use ($guruId) {
                $query->where('wali_kelas_id', $guruId)
                    ->orWhere('pendamping_id', $guruId);
            })
            ->first();

        if (!$kelas) {
            return redirect()->route('mulok.index')->with('error', 'Kelas tidak ditemukan.');
        }

        $anggotaKelas = AnggotaKelas::with(['siswa', 'muloks' => function($q) use ($id) {
            $q->where('mapel_id', $id);
        }])
        ->where('kelas_id', $kelas->id)
        ->get();

        return view('guru.muloks.edit', compact('mapel', 'kelas', 'anggotaKelas'));
    }

    public function update(MulokRequest $request, string $id)
    {
        $inputPh = $request->input('nilai_ph', []);
        $inputPts = $request->input('nilai_npts', []);

        $anggotaKelasIds = array_unique(array_merge(array_keys($inputPh), array_keys($inputPts)));

        foreach ($anggotaKelasIds as $anggotaKelasId) {
            $ph = $inputPh[$anggotaKelasId] ?? null;
            $npts = $inputPts[$anggotaKelasId] ?? null;

            if (($ph !== null && $ph !== '') || ($npts !== null && $npts !== '')) {
                $angkaPh = is_numeric($ph) ? floatval($ph) : 0;
                $angkaPts = is_numeric($npts) ? floatval($npts) : 0;
                $nilaiAkhir = ($angkaPh + $angkaPts) / 2;

                Mulok::updateOrCreate(
                    [
                        'anggota_kelas_id' => $anggotaKelasId,
                        'mapel_id' => $id,
                    ],
                    [
                        'nilai_ph' => $ph !== '' ? $ph : null,
                        'nilai_npts' => $npts !== '' ? $npts : null,
                        'nilai_akhir' => $nilaiAkhir,
                    ]
                );
            } else {
                Mulok::where('anggota_kelas_id', $anggotaKelasId)
                    ->where('mapel_id', $id)
                    ->delete();
            }
        }

        return redirect()
            ->route('mulok.edit', $id)
            ->with('success', 'Data nilai Mulok berhasil disimpan!');
    }

    public function destroy(string $id) {}
}