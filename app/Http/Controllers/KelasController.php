<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Guru;
use App\Models\TahunAjaran;
use App\Http\Requests\KelasRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahunAjarans = TahunAjaran::latest()->first();
        if ($tahunAjarans){
            $kelas = Kelas::with(['waliKelas','pendamping','tahunAjaran'])->whereTahunAjaranId($tahunAjarans->id)->get();
            $gurus = Guru::all();
        } else {
            return redirect()
                ->route('tahun_ajaran.index');
        }
        
        return view('admin.kelas.index', compact('kelas','gurus','tahunAjarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelas.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KelasRequest $request)
    {
        Kelas::firstOrCreate($request->validated());

        return redirect()
            ->route('kelas.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        return view('admin.kelas.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KelasRequest $request, Kelas $kelas)
    {
        $kelas->update($request->validated());

        return redirect()
            ->route('kelas.index')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()
            ->route('kelas.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}
