<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKelas;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Http\Requests\AnggotaKelasRequest;
use Illuminate\Http\Request;

class AnggotaKelasController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()
            ->back()
            ->with('success', 'Data anggota kelas berhasil diimport');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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

        return view('admin.anggota_kelas.index', compact('anggotaKelas', 'siswas', 'kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.anggota_kelas.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnggotaKelasRequest $request)
    {
        AnggotaKelas::firstOrCreate($request->validated());

        return redirect()
            ->route('anggota-kelas.index')
            ->with('success', 'Data siswa berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(AnggotaKelas $anggotaKelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnggotaKelas $anggotaKelas)
    {
        return view('admin.anggota_kelas.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnggotaKelasRequest $request, AnggotaKelas $anggotaKelas)
    {
        $anggotaKelas->update($request->validated());

        return redirect()
            ->route('anggota-kelas.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnggotaKelas $anggotaKelas)
    {
        $anggotaKelas->delete();

        return redirect()
            ->route('anggota-kelas.index')
            ->with('success', 'Siswa berhasil dihapus dari anggota kelas!');
    }
}
