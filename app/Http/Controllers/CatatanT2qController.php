<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKelas;
use App\Models\CatatanT2q;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class CatatanT2qController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $guruId = $user->guru?->id;

        if (!$guruId) {
            $catatans = collect();
            return view('t2q.catatans.index', compact('catatans'));
        }

        $tahunAjaranAktif = TahunAjaran::latest()->first();

        // Cari AnggotaKelas yang terhubung ke Guru T2Q lewat relasi 'halaqah'
        $catatans = AnggotaKelas::whereHas('kelas', function ($q) use ($tahunAjaranAktif) {
                if ($tahunAjaranAktif) {
                    $q->where('tahun_ajaran_id', $tahunAjaranAktif->id);
                }
            })
            ->whereHas('halaqah', function ($q) use ($guruId) {
                // Filter berdasarkan guru_id di tabel halaqah_siswas
                $q->where('guru_id', $guruId); 
                // Catatan: Jika di tabel halaqah_siswas nama kolomnya guru_t2q_id, 
                // ubah 'guru_id' di atas menjadi 'guru_t2q_id'
            })
            ->with(['siswa', 'catatanT2q', 'halaqah'])
            ->get();

        return view('t2q.catatans.index', compact('catatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'catatan'   => 'nullable|array',
            'catatan.*' => 'nullable|string',
        ]);

        $guruId = auth()->user()->guru?->id;

        if ($request->has('catatan')) {
            foreach ($request->catatan as $anggotaKelasId => $isiCatatan) {
                CatatanT2q::updateOrCreate(
                    ['anggota_kelas_id' => $anggotaKelasId],
                    [
                        'guru_id' => $guruId,
                        'catatan' => $isiCatatan,
                    ]
                );
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Catatan T2Q siswa berhasil disimpan!');
    }
}