<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use App\Models\Kelas;
use App\Http\Requests\TahunAjaranRequest;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahun_ajarans = TahunAjaran::orderBy('id', 'desc')->get();

        return view('admin.tahun.index', compact('tahun_ajarans'));
    }

    public function create()
    {
        return redirect()->route('tahun_ajaran.index');
    }

    public function store(TahunAjaranRequest $request)
    {
        TahunAjaran::firstOrCreate($request->validated());

        return redirect()
            ->route('tahun_ajaran.index')
            ->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    public function show(TahunAjaran $tahunAjaran)
    {
        return redirect()->route('tahun_ajaran.index');
    }

    public function edit(TahunAjaran $tahunAjaran)
    {
        return redirect()->route('tahun_ajaran.index');
    }

    public function update(TahunAjaranRequest $request, TahunAjaran $tahunAjaran) 
    {
        $tahunAjaran->update($request->validated());

        return redirect()
            ->route('tahun_ajaran.index')
            ->with('success', 'Tahun ajaran berhasil diperbarui.');
    }

    public function destroy(TahunAjaran $tahunAjaran)
    {
        Kelas::where('tahun_ajaran_id', $tahunAjaran->id)->delete();

        $tahunAjaran->delete();

        return redirect()
            ->route('tahun_ajaran.index')
            ->with('success', 'Tahun ajaran beserta kelas terkait berhasil dihapus.');
    }
}