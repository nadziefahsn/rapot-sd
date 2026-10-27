<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKelas;
use App\Models\Deskripsi;
use App\Models\Intrakulikuler;
use App\Models\TahunAjaran;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class IntrakulikulerController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $tahunAjaranAktif = TahunAjaran::latest()->first();
        if (!$tahunAjaranAktif) {
            return redirect()->route('dashboard');
        }

        $kelas = Kelas::where('tahun_ajaran_id', $tahunAjaranAktif->id)->orderBy('rombel', 'asc')->get();

        $anggotaKelasQuery = AnggotaKelas::with(['siswa', 'kelas'])->where(function ($query) use ($tahunAjaranAktif) {
            $query->whereNull('kelas_id')
                ->orWhereHas('kelas', function ($q) use ($tahunAjaranAktif) {
                    $q->where('tahun_ajaran_id', $tahunAjaranAktif->id);
                });
        });

        $anggotaKelas = $anggotaKelasQuery->get();
        $siswas = Siswa::orderBy('nama_siswa', 'asc')->get();

        $deskripsis = Deskripsi::with(['mapel', 'kelas'])
            ->where('tahun_ajaran_id', $tahunAjaranAktif->id)
            ->whereHas('mapel', function ($query) {
                $query->where('kategori', 'Intrakulikuler');
            })
            ->get();

        return view('guru.intrakulikulers.index', compact('anggotaKelas', 'deskripsis', 'tahunAjaranAktif'));
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
        $intrakulikuler->delete();
        return redirect()->back()->with('success', 'Data nilai berhasil dihapus');
    }
}