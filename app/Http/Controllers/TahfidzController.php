<?php

namespace App\Http\Controllers;

use App\Models\Tahfidz;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahfidzController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahunAjaranAktif = TahunAjaran::latest()->first();
        return view('t2q.tahfidz.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tahfidz $tahfidz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tahfidz $tahfidz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tahfidz $tahfidz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tahfidz $tahfidz)
    {
        //
    }
}
