<?php

namespace App\Http\Controllers;

use App\Models\Deskripsi;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\TahunAjaran;
use App\Http\Requests\DeskripsiRequest;
use Illuminate\Support\Facades\DB;

class DeskripsiController extends Controller
{
    public function duplicateFromPreviousSemester()
    {
        $semesters = TahunAjaran::latest()->take(2)->get();

        if ($semesters->count() < 2) {
            return redirect()->route('deskripsi.index')
                ->with('error', 'Minimal harus ada 2 data semester (Tahun Ajaran) di sistem untuk melakukan penyalinan.');
        }

        $semesterBaru = $semesters[0];
        $semesterLama = $semesters[1];

        $deskripsiLama = Deskripsi::where('tahun_ajaran_id', $semesterLama->id)->get();

        if ($deskripsiLama->isEmpty()) {
            return redirect()->route('deskripsi.index')
                ->with('warning', 'Tidak ada data deskripsi mata pelajaran di semester sebelumnya untuk disalin.');
        }

        DB::transaction(function () use ($deskripsiLama, $semesterBaru) {
            $dataInsert = [];
            $now = now();

            foreach ($deskripsiLama as $item) {
                $dataInsert[] = [
                    'tahun_ajaran_id' => $semesterBaru->id,
                    'kelas_id'        => $item->kelas_id,
                    'mapel_id'        => $item->mapel_id,
                    'deskripsi'       => $item->deskripsi,
                    'created_at'      => $now,
                    'updated_at'      => $now,
                ];
            }

            Deskripsi::insert($dataInsert);
        });

        return redirect()->route('deskripsi.index')
            ->with('success', 'Data deskripsi mata pelajaran berhasil disalin dari semester sebelumnya.');
    }

    public function index()
    {
        $tahunAjaranAktif = TahunAjaran::latest()->first();
        if (!$tahunAjaranAktif) {
            $deskripsis = collect();
        } else {
            $deskripsis = Deskripsi::with(['kelas', 'mapel'])
                ->where('tahun_ajaran_id', $tahunAjaranAktif->id)
                ->latest()
                ->get();
        }

        $kelases = Kelas::all()
            ->map(function ($kelas) {
                $kelas->jenjang = preg_replace('/[^0-9]/', '', $kelas->rombel ?? $kelas->nama_kelas);
                return $kelas;
            })
            ->unique('jenjang')
            ->sortBy('jenjang');
        $mapels = Mapel::all();

        return view('admin.deskripsis.index', compact('deskripsis', 'kelases', 'mapels', 'tahunAjaranAktif'));
    }

    public function create()
    {
        //
    }

    public function store(DeskripsiRequest $request)
    {
        $data = $request->validated();
        
        $kelasPilihan = Kelas::findOrFail($data['kelas_id']);

        $jenjang = preg_replace('/[^0-9]/', '', $kelasPilihan->rombel);

        $semuaKelasSejenjang = Kelas::where('tahun_ajaran_id', $kelasPilihan->tahun_ajaran_id)
            ->where('rombel', 'LIKE', $jenjang . '%')
            ->get();

        DB::transaction(function () use ($semuaKelasSejenjang, $data) {
            foreach ($semuaKelasSejenjang as $k) {
                Deskripsi::updateOrCreate(
                    [
                        'tahun_ajaran_id' => $data['tahun_ajaran_id'] ?? $k->tahun_ajaran_id,
                        'kelas_id'        => $k->id,
                        'mapel_id'        => $data['mapel_id'],
                    ],
                    [
                        'deskripsi'       => $data['deskripsi'],
                    ]
                );
            }
        });

        return redirect()->back()->with('success', 'Deskripsi mata pelajaran berhasil disimpan untuk seluruh kelas jenjang ' . $jenjang . '!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(DeskripsiRequest $request, string $id)
    {
        $data = $request->validated();
        $deskripsiUtama = Deskripsi::findOrFail($id);

        $kelasPilihan = Kelas::findOrFail($deskripsiUtama->kelas_id);
        $jenjang = preg_replace('/[^0-9]/', '', $kelasPilihan->rombel);

        $semuaKelasSejenjang = Kelas::where('tahun_ajaran_id', $kelasPilihan->tahun_ajaran_id)
            ->where('rombel', 'LIKE', $jenjang . '%')
            ->get();

        DB::transaction(function () use ($semuaKelasSejenjang, $data) {
            foreach ($semuaKelasSejenjang as $k) {
                Deskripsi::updateOrCreate(
                    [
                        'tahun_ajaran_id' => $data['tahun_ajaran_id'] ?? $k->tahun_ajaran_id,
                        'kelas_id'        => $k->id,
                        'mapel_id'        => $data['mapel_id'],
                    ],
                    [
                        'deskripsi'       => $data['deskripsi'],
                    ]
                );
            }
        });

        return redirect()->back()->with('success', 'Deskripsi mata pelajaran berhasil diperbarui untuk seluruh kelas jenjang ' . $jenjang . '!');
    }

    public function destroy(string $id)
    {
        $deskripsi = Deskripsi::findOrFail($id);
        $deskripsi->delete();

        return redirect()->back()->with('success', 'Deskripsi mata pelajaran berhasil dihapus!');
    }
}