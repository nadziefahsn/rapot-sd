<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakulikuler;
use App\Models\EkstrakulikulerSiswa;
use App\Models\NilaiEkstrakulikuler;
use App\Models\TahunAjaran;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NilaiEkstrakulikulerController extends Controller
{
    public function index()
    {
        $tahunAjaranAktif = TahunAjaran::latest()->first();
        $tahunAjaranId = $tahunAjaranAktif ? $tahunAjaranAktif->id : null;

        $userLoginId = Auth::id();

        $guru = Guru::where('user_id', $userLoginId)->first();

        if (!$guru) {
            return view('guru.nilai_eskul.index', ['dataEskul' => []]);
        }

        $ekstrakulikulers = Ekstrakulikuler::when($tahunAjaranId, function ($q) use ($tahunAjaranId) {
            $q->where('tahun_ajaran_id', $tahunAjaranId);
        })
        ->where('pendamping_id', $guru->id) 
        ->get();

        $dataEskul = [];
        foreach ($ekstrakulikulers as $eskul) {
            $totalSiswa = EkstrakulikulerSiswa::where('ekstrakulikuler_id', $eskul->id)->count();
            
            $sudahDinilaiCount = NilaiEkstrakulikuler::whereHas('ekstrakulikulerSiswa', function ($q) use ($eskul) {
                $q->where('ekstrakulikuler_id', $eskul->id);
            })->count();

            if ($totalSiswa > 0 && $sudahDinilaiCount >= $totalSiswa) {
                $status = 'Sudah Dinilai';
            } elseif ($sudahDinilaiCount > 0) {
                $status = 'Sebagian Dinilai';
            } else {
                $status = 'Belum Dinilai';
            }

            $dataEskul[] = (object) [
                'id'                   => $eskul->id,
                'nama_ekstrakulikuler' => $eskul->nama_ekstrakulikuler,
                'status_penilaian'     => $status
            ];
        }

        return view('guru.nilai_eskul.index', compact('dataEskul'));
    }

    public function edit($id)
    {
        $userLoginId = Auth::id();
        $guru = Guru::where('user_id', $userLoginId)->first();

        if (!$guru) {
            return redirect()->route('nilai-eskul.index')
                             ->with('error', 'Akses ditolak. Data guru tidak ditemukan.');
        }

        $eskul = Ekstrakulikuler::where('id', $id)
                    ->where('pendamping_id', $guru->id)
                    ->first();

        if (!$eskul) {
            return redirect()->route('nilai-eskul.index')
                             ->with('error', 'Anda tidak memiliki akses untuk menilai ekstrakurikuler ini.');
        }

        $siswas = EkstrakulikulerSiswa::with(['anggotaKelas.siswa', 'anggotaKelas.kelas', 'nilaiEkstrakulikuler'])
                    ->where('ekstrakulikuler_id', $id)
                    ->get();

        $sudahAdaNilai = NilaiEkstrakulikuler::whereHas('ekstrakulikulerSiswa', function ($q) use ($id) {
            $q->where('ekstrakulikuler_id', $id);
        })->exists();

        return view('guru.nilai_eskul.edit', compact('eskul', 'siswas', 'sudahAdaNilai'));
    }

    public function store(Request $request, $id)
    {
        return $this->saveNilai($request, $id);
    }

    public function update(Request $request, $id)
    {
        return $this->saveNilai($request, $id);
    }

    private function saveNilai(Request $request, $id)
    {
        $userLoginId = Auth::id();
        $guru = Guru::where('user_id', $userLoginId)->first();

        if (!$guru) {
            return redirect()->route('nilai-eskul.index')
                             ->with('error', 'Aksi ditolak. Data guru tidak ditemukan.');
        }

        $eskul = Ekstrakulikuler::where('id', $id)
                    ->where('pendamping_id', $guru->id)
                    ->first();

        DB::transaction(function () use ($request) {
            if ($request->has('nilai')) {
                foreach ($request->nilai as $eskulSiswaId => $predikat) {
                    NilaiEkstrakulikuler::updateOrCreate(
                        [
                            'ekstrakulikuler_siswa_id' => $eskulSiswaId,
                        ],
                        [
                            'nilai' => $predikat ?? null,
                        ]
                    );
                }
            }
        });

        return redirect()->back()->with('success', 'Data Nilai Ekstrakulikuler berhasil disimpan!');
    }
}