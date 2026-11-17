<?php

namespace App\Http\Controllers;

use App\Http\Requests\NilaiTahsinRequest;
use App\Models\NilaiTahsin;
use App\Models\Mapel;
use App\Models\TahunAjaran;
use App\Models\Kelas;
use App\Models\AnggotaKelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NilaiTahsinController extends Controller
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
            $sudahDinilai = NilaiTahsin::whereHas('anggotaKelas', function ($q) use ($kelas, $guruId) {
                $q->where('kelas_id', $kelas->id)
                ->whereHas('halaqahSiswas', function ($hq) use ($guruId) {
                    $hq->where('guru_id', $guruId);
                });
            })->exists();

            $kelas->status_penilaian = $sudahDinilai ? 'Sudah Dinilai' : 'Belum Dinilai';
        }

        return view('t2q.nilai_tahsin.index', compact('kelases'));
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
    public function store(NilaiTahsinRequest $request)
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

        $mapelTahsin = Mapel::where('kategori', 'Tahsin')->first();

        $siswas = AnggotaKelas::with(['siswa', 'nilaiTahsin'])
            ->where('kelas_id', $kelasId)
            ->whereHas('halaqahSiswas', function ($q) use ($guruId) {
                $q->where('guru_id', $guruId);
            })
            ->get();

        $sudahAdaNilai = NilaiTahsin::whereHas('anggotaKelas', function ($q) use ($kelasId, $guruId) {
            $q->where('kelas_id', $kelasId)
              ->whereHas('halaqahSiswas', function ($hq) use ($guruId) {
                  $hq->where('guru_id', $guruId);
              });
        })->exists();

        $opsiCatatan = [
            'hukum mad',
            'hukum nun sukun atau tanwin',
            'hukum alif lam',
            'makhraj huruf',
            'sifat huruf',
            'gunnah'
        ];

        return view('t2q.nilai_tahsin.edit', compact('siswas', 'kelas', 'sudahAdaNilai', 'opsiCatatan', 'mapelTahsin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NilaiTahsinRequest $request)
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

    private function saveNilai(NilaiTahsinRequest $request)
    {
        $mapelId = $request->input('mapel_id');

        if (!$mapelId) {
            $mapelId = Mapel::where('kategori', 'Tahsin')
                ->orWhere('mapel', 'LIKE', '%Tahsin%')
                ->orWhere('mapel', 'LIKE', '%T2Q%')
                ->value('id');
        }

        if (!$mapelId) {
            return redirect()->back()->with('error', 'Mata pelajaran Tahsin/T2Q belum terdaftar di tabel Mapel.');
        }

        DB::transaction(function () use ($request, $mapelId) {
            $tahsinInputs = $request->input('tahsin', []);

            foreach ($tahsinInputs as $anggotaKelasId => $data) {
                if (!empty($data['jilid']) || !empty($data['halaman']) || isset($data['nilai']) || !empty($data['kekurangan']) || !empty($data['kelebihan'])) {
                    NilaiTahsin::updateOrCreate(
                        [
                            'anggota_kelas_id' => $anggotaKelasId,
                            'mapel_id'         => $mapelId,
                        ],
                        [
                            'jilid'      => $data['jilid'] ?? null,
                            'halaman'    => $data['halaman'] ?? null,
                            'nilai'      => (isset($data['nilai']) && $data['nilai'] !== '') ? $data['nilai'] : null,
                            'kekurangan' => $data['kekurangan'] ?? [],
                            'kelebihan'  => $data['kelebihan'] ?? [],
                        ]
                    );
                }
            }
        });

        return redirect()->back()->with('success', 'Data Nilai Tahsin berhasil disimpan!');
    }
}