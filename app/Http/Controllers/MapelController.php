<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use App\Http\Requests\MapelRequest;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapels = Mapel::latest()->get();
        return view('admin.mapels.index', compact('mapels'));
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
    public function store(MapelRequest $request)
    {
        Mapel::firstOrCreate($request->validated());

        return redirect()->back()->with('success', 'Mata Pelajaran berhasil ditambahkan!');
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
    public function update(MapelRequest $request, string $id)
    {
        $mapel = Mapel::findOrFail($id);
        
        $mapel->update($request->validated());

        return redirect()->back()->with('success', 'Mata Pelajaran berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mapel = Mapel::findOrFail($id);
        
        $mapel->kelas()->detach(); 
        $mapel->delete();

        return redirect()->back()->with('success', 'Mata Pelajaran berhasil dihapus!');
    }
}
