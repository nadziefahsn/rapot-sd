<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatatanRequest;
use App\Models\Catatan;
use App\Models\Kelas;
use App\Models\AnggotaKelas;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class CatatanController extends Controller
{
    public function index()
    {
        $tahunAjaranAktif = TahunAjaran::latest()->first();

        // if (!$tahunAjaranAktif) {
        //     return redirect()->route('dashboard')->with('error', 'Tahun ajaran aktif belum ditentukan.');
        // }

        // Ambil kelas sesuai tahun ajaran aktif
        $kelas = Kelas::where('tahun_ajaran_id', $tahunAjaranAktif->id)
            ->orderBy('rombel', 'asc')
            ->get();

        $kelasIds = $kelas->pluck('id');

        // Ambil anggota kelas beserta relasinya
        $catatans = AnggotaKelas::whereIn('kelas_id', $kelasIds)
            ->with(['siswa', 'kelas', 'catatan'])
            ->get();

        return view('guru.catatans.index', compact('catatans', 'kelas', 'tahunAjaranAktif'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Catatan $catatan)
    {
        //
    }

    public function edit(Catatan $catatan)
    {
        //
    }

    public function update(CatatanRequest $request)
    {
        $validated = $request->validated();

        foreach ($validated['catatan'] as $anggotaKelasId => $isiCatatan) {
            Catatan::updateOrCreate(
                ['anggota_kelas_id' => $anggotaKelasId],
                ['catatan'          => $isiCatatan]
            );
        }

        return redirect()
            ->back()
            ->with('success', 'Catatan berhasil disimpan');
    }

    public function destroy(Catatan $catatan)
    {
        //
    }
}