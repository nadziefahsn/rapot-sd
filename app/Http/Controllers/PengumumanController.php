<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Http\Requests\PengumumanRequest;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengumumans = Pengumuman::latest()->get();

        return view('admin.pengumumans.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('pengumumans.create');
    }

    public function store(PengumumanRequest $request)
    {
        Pengumuman::firstOrCreate([
            'user_id' => auth()->id(),
            'judul'   => $request->judul,
            'isi'     => $request->isi,
        ]);

        return redirect()
            ->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan');
    }


    public function show(Pengumuman $pengumuman)
    {

    }

    public function edit(Pengumuman $pengumuman)
    {
        return redirect()
            ->route('pengumuman.index');
    }


    public function update(PengumumanRequest $request, Pengumuman $pengumuman)
    {
        $data = $request->validated();

        $pengumuman->update($data);

        return redirect()
            ->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect()
            ->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus');
    }
}