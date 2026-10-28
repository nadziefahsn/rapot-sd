<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\AnggotaKelas;
use App\Models\HalaqahSiswa;
use Illuminate\Http\Request;

class GuruT2qController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guruT2q = Guru::where('jabatan', 'LIKE', '%T2Q%')
        ->withCount('siswaHalaqah')
        ->get();

        return view('admin.guru_t2q.index', compact('guruT2q'));
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
    public function store(Request $request)
    {
        $request->validate([
        'guru_id'             => 'required|exists:gurus,id',
        'anggota_kelas_ids'   => 'required|array',
        'anggota_kelas_ids.*' => 'exists:anggota_kelas,id',
    ]);

    foreach ($request->anggota_kelas_ids as $anggotaId) {
        HalaqahSiswa::firstOrCreate([
            'guru_id'          => $request->guru_id,
            'anggota_kelas_id' => $anggotaId,
        ]);
    }

    return redirect()->route('guru-t2q.show', $request->guru_id)
        ->with('success', 'Anggota kelompok T2Q berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guru = Guru::with([
        'siswaHalaqah.anggotaKelas.siswa',
        'siswaHalaqah.anggotaKelas.kelas'
        ])->findOrFail($id);

        $assignedAnggotaIds = HalaqahSiswa::pluck('anggota_kelas_id')->toArray();

        $allAnggotaKelas = AnggotaKelas::with(['siswa', 'kelas'])
            ->whereNotIn('id', $assignedAnggotaIds)
            ->get();

        return view('admin.guru_t2q.show', compact('guru', 'allAnggotaKelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $guru = Guru::findOrFail($id);
        
        $allAnggotaKelas = AnggotaKelas::with(['siswa', 'kelas'])->get();
        
        $assignedAnggotaIds = HalaqahSiswa::where('guru_id', $id)
            ->pluck('anggota_kelas_id')
            ->toArray();

        return view('admin.guru_t2q.edit', compact('guru', 'allAnggotaKelas', 'assignedAnggotaIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'anggota_kelas_ids' => 'nullable|array',
            'anggota_kelas_ids.*' => 'exists:anggota_kelas,id',
        ]);

        HalaqahSiswa::where('guru_id', $id)->delete();

        if ($request->has('anggota_kelas_ids')) {
            foreach ($request->anggota_kelas_ids as $anggotaId) {
                HalaqahSiswa::create([
                    'guru_id' => $id,
                    'anggota_kelas_id' => $anggotaId,
                ]);
            }
        }

        return redirect()->route('guru-t2q.index')
            ->with('success', 'Anggota halaqah T2Q berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $halaqahSiswa = HalaqahSiswa::findOrFail($id);
    
        $guruId = $halaqahSiswa->guru_id;
        
        $halaqahSiswa->delete();

        return redirect()->route('guru-t2q.show', $guruId)
            ->with('success', 'Anggota berhasil dihapus dari kelompok T2Q!');
    }
}
