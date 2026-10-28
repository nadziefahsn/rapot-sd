<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKelas;
use App\Models\Deskripsi;
use App\Models\Intrakulikuler;
use App\Models\TahunAjaran;
use App\Models\Kelas;
use Illuminate\Http\Request;

class IntrakulikulerController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $tahunAjaranAktif = TahunAjaran::latest()->first();

        // if (!$tahunAjaranAktif) {
        //     return redirect()->route('dashboard')->with('error', 'Tahun ajaran aktif belum ditentukan.');
        // }

        $guruId = $user->guru?->id;

        $kelas = Kelas::where('tahun_ajaran_id', $tahunAjaranAktif->id)
            ->where(function ($query) use ($guruId) {
                $query->where('wali_kelas_id', $guruId)
                    ->orWhere('pendamping_id', $guruId);
            })
            ->orderBy('rombel', 'asc')
            ->get();

        $kelasIds = $kelas->pluck('id');

        $anggotaKelas = AnggotaKelas::whereIn('kelas_id', $kelasIds)
            ->with(['siswa', 'kelas', 'intrakulikuler'])
            ->get();

        $deskripsis = Deskripsi::with(['mapel', 'kelas'])
            ->where('tahun_ajaran_id', $tahunAjaranAktif->id)
            ->whereIn('kelas_id', $kelasIds)
            ->whereHas('mapel', function ($query) {
                $query->where('kategori', 'Intrakulikuler');
            })
            ->get();

        return view('guru.intrakulikulers.index', compact('anggotaKelas', 'deskripsis', 'tahunAjaranAktif', 'kelas'));    
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Intrakulikuler $intrakulikuler)
    {
        //
    }

    public function edit(Intrakulikuler $intrakulikuler)
    {
        //
    }

    public function update(Request $request)
    {
        $tahunAjaranAktif = TahunAjaran::latest()->first();

        if (!$tahunAjaranAktif) {
            return redirect()->back()->with('error', 'Data Tahun Ajaran belum ada di database!');
        }

        $nilaiData = $request->input('nilai', []);

        foreach ($nilaiData as $anggotaKelasId => $mapelValues) {
            foreach ($mapelValues as $deskripsiId => $nilaiAngka) {
                if ($nilaiAngka !== null && $nilaiAngka !== '') {
                    Intrakulikuler::updateOrCreate(
                        [
                            'anggota_kelas_id' => $anggotaKelasId,
                            'deskripsi_id'     => $deskripsiId,
                        ],
                        [
                            'nilai'            => $nilaiAngka,
                        ]
                    );
                }
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Data nilai intrakulikuler berhasil disimpan');
    }
    
    public function destroy(Intrakulikuler $intrakulikuler)
    {
        //
    }
}