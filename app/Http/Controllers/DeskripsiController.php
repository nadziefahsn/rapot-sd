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
    /**
     * Display a listing of the resource.
     */
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

        $kelases = Kelas::all();
        $mapels = Mapel::all();

        return view('admin.deskripsis.index', compact('deskripsis', 'kelases', 'mapels', 'tahunAjaranAktif'));
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
    public function store(DeskripsiRequest $request)
    {
        Deskripsi::firstOrCreate($request->validated());

        return redirect()->back()->with('success', 'Deskripsi mata pelajaran berhasil ditambahkan!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeskripsiRequest $request, string $id)
    {
        $deskripsi = Deskripsi::findOrFail($id);
        $deskripsi->update($request->validated());

        return redirect()->back()->with('success', 'Deskripsi mata pelajaran berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deskripsi = Deskripsi::findOrFail($id);
        $deskripsi->delete();

        return redirect()->back()->with('success', 'Deskripsi mata pelajaran berhasil dihapus!');
    }
}
