<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use App\Models\AnggotaKelas;
use App\Models\Catatan;
use App\Models\Kehadiran;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class PdfController extends Controller
{
    public function index(Request $request)
    {
        $anggotaKelasId = $request->input('anggota_id');

        if (!$anggotaKelasId) {
            $anggotaKelas = AnggotaKelas::first();

            if (!$anggotaKelas) {
                return redirect()->back()->with('error', 'Data anggota kelas tidak ditemukan.');
            }

            $anggotaKelasId = $anggotaKelas->id;
        }

        return $this->show($request, $anggotaKelasId);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function show(string $id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            $decryptedId = $id;
        }

        $pdfOptions = [
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'chroot' => public_path(),
        ];

        $kehadirans = Kehadiran::all();
        $tahunAjarans = TahunAjaran::all();
        $catatan = Catatan::all();
        $mapelAmalanIbadah = Mapel::where('kategori', 'Amal Ibadah')->get();

        $anggotaKelas = AnggotaKelas::with([
            'siswa', 
            'kelas.waliKelas',
            'kehadiran',
            'catatan',
            'amalanIbadahs'
        ])->findOrFail($decryptedId);

        $siswa = $anggotaKelas->siswa;
        $tahunAjaranAktif = TahunAjaran::latest()->first();

        $pdf = Pdf::loadView('pdf.rapot', compact(
            'anggotaKelas',
            'siswa',
            'kehadirans',
            'catatan',
            'mapelAmalanIbadah',
            'tahunAjaranAktif'
        ))->setPaper('A4', 'portrait')
        ->setOption($pdfOptions);

        $namaKelas = $anggotaKelas->kelas->rombel ?? 'Kelas';
        $namaSiswa = $siswa->nama_siswa ?? 'Siswa';
        $fileName = 'Penilaian Karakter & Biodata - ' . trim($namaKelas) . '_' . trim($namaSiswa) . '.pdf';

        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $fileName . '"',
        ]);
    }

    public function edit(string $id)
    {
        
    }

    public function update(Request $request, string $id)
    {
        
    }

    public function destroy(string $id)
    {
        
    }
}