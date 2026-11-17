<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakulikuler;
use App\Models\EkstrakulikulerSiswa;
use App\Models\AnggotaKelas;
use App\Models\TahunAjaran;
use App\Models\Guru;
use App\Http\Requests\EkstrakulikulerRequest; 
use Illuminate\Http\Request;

class EkstrakulikulerController extends Controller
{
    public function index()
    {
        $ekstrakulikulers = Ekstrakulikuler::with(['tahunAjaran', 'pendamping'])
            ->withCount('anggotaEskul') 
            ->get();
            
        $gurus = Guru::all(); 
        $tahunAjaranAktif = TahunAjaran::latest()->first(); 

        return view('admin.ekstrakulikulers.index', compact('ekstrakulikulers', 'gurus', 'tahunAjaranAktif'));
    }

    public function create()
    {
        $tahunAjaranAktif = TahunAjaran::latest()->first();
        $gurus = Guru::all();

        return view('admin.ekstrakulikulers.create', compact('tahunAjaranAktif', 'gurus'));
    }

    public function store(EkstrakulikulerRequest $request)
    {
        Ekstrakulikuler::create($request->validated());

        return redirect()->route('ekstrakulikuler.index')
            ->with('success', 'Data ekstrakulikuler berhasil ditambahkan.');
    }

    public function show($id)
    {
        $ekstrakulikuler = Ekstrakulikuler::with([
            'tahunAjaran',
            'pendamping',
            'anggotaEskul.anggotaKelas.siswa', 
            'anggotaEskul.anggotaKelas.kelas'
        ])->findOrFail($id);

        $existingAnggotaKelasIds = $ekstrakulikuler->anggotaEskul->pluck('anggota_kelas_id');

        $anggotaKelasList = AnggotaKelas::with(['siswa', 'kelas'])
            ->whereNotIn('id', $existingAnggotaKelasIds)
            ->get();

        return view('admin.ekstrakulikulers.show', compact('ekstrakulikuler', 'anggotaKelasList'));
    }

    public function edit(Ekstrakulikuler $ekstrakulikuler)
    {
        $gurus = Guru::all();
        $tahunAjaranAktif = TahunAjaran::latest()->first();

        return view('admin.ekstrakulikulers.edit', compact('ekstrakulikuler', 'gurus', 'tahunAjaranAktif'));
    }

    public function update(Request $request, Ekstrakulikuler $ekstrakulikuler)
    {
        if ($request->has('anggota_kelas_id')) {
            $request->validate([
                'anggota_kelas_id' => 'required|exists:anggota_kelas,id',
            ]);

            $exists = EkstrakulikulerSiswa::where('ekstrakulikuler_id', $ekstrakulikuler->id)
                ->where('anggota_kelas_id', $request->anggota_kelas_id)
                ->exists();

            if ($exists) {
                return back()->with('error', 'Siswa tersebut sudah terdaftar di ekstrakulikuler ini.');
            }

            EkstrakulikulerSiswa::create([
                'ekstrakulikuler_id' => $ekstrakulikuler->id,
                'anggota_kelas_id'   => $request->anggota_kelas_id,
            ]);

            return back()->with('success', 'Siswa berhasil ditambahkan ke ekstrakulikuler.');
        }

        $request->validate([
            'nama_ekstrakulikuler' => 'required|string|max:255',
            'guru_id'              => 'required|exists:gurus,id',
        ]);

        $ekstrakulikuler->update([
            'nama_ekstrakulikuler' => $request->nama_ekstrakulikuler,
            'guru_id'              => $request->guru_id,
        ]);

        return redirect()->route('ekstrakulikuler.index')
            ->with('success', 'Data ekstrakulikuler berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $eskulSiswa = EkstrakulikulerSiswa::find($id);
        if ($eskulSiswa) {
            $eskulSiswa->delete();
            return back()->with('success', 'Siswa berhasil dikeluarkan dari ekstrakulikuler.');
        }

        $ekstrakulikuler = Ekstrakulikuler::findOrFail($id);
        $ekstrakulikuler->delete();

        return redirect()->route('ekstrakulikuler.index')
            ->with('success', 'Data ekstrakulikuler berhasil dihapus.');
    }
}