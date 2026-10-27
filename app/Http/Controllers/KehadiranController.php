<?php

namespace App\Http\Controllers;

use App\Http\Requests\KehadiranRequest;
use App\Models\AnggotaKelas;
use App\Models\Kehadiran;
use App\Models\TahunAjaran;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $tahunAjaran = TahunAjaran::latest()->first();
        // if (!$tahunAjaran) {
        //      return redirect()->route('dashboard');
        // }

        if ($user) {
            $guruId = $user->guru?->id;

            $kelasIds = Kelas::where('tahun_ajaran_id', $tahunAjaran->id)
                ->where(function ($query) use ($guruId) {
                    $query->where('wali_kelas_id', $guruId)
                        ->orWhere('pendamping_id', $guruId);
                })
                ->pluck('id');

            $data_anggota_kelas = AnggotaKelas::whereIn('kelas_id', $kelasIds)
                ->with(['siswa', 'kehadiran'])
                ->get();
        } else {
            $data_anggota_kelas = AnggotaKelas::whereHas('kelas', function ($query) use ($tahunAjaran) {
                    $query->where('tahun_ajaran_id', $tahunAjaran->id);
                })
                ->with(['siswa', 'kehadiran'])
                ->get();
        }

        return view('guru.kehadirans.index', compact('data_anggota_kelas'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
      
    }

    public function show(Kehadiran $kehadiran)
    {
        
    }

    public function edit(Kehadiran $kehadiran)
    {
        
    }

    public function update(KehadiranRequest $request)
    {
        $validated = $request->validated();

        $guruId = $request->input('guru_id');

        $tahunAjaran = TahunAjaran::latest()->first();

        if (!$tahunAjaran) {
            return redirect()->back()->with('error', 'Data Tahun Ajaran belum ada di database!');
        }

        foreach ($validated['anggota_kelas_id'] as $index => $anggotaId) {
            Kehadiran::updateOrCreate(
                [
                    'anggota_kelas_id' => $anggotaId,
                    'tahun_ajaran_id'  => $tahunAjaran->id, 
                ],
                [
                    'sakit'            => $validated['sakit'][$index] ?? 0,
                    'izin'             => $validated['izin'][$index] ?? 0,
                    'tanpa_keterangan' => $validated['tanpa_keterangan'][$index] ?? 0,
                ]
            );
        }

        return redirect()
            ->route('kehadiran.index', ['guru_id' => $guruId])
            ->with('success', 'Data kehadiran berhasil disimpan!');
    }

    public function destroy(Kehadiran $kehadiran)
    {
        
    }
}