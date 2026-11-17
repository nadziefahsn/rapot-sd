<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use App\Models\AnggotaKelas;
use App\Models\Catatan;
use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\Deskripsi;
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
        $tahunAjaranAktif = TahunAjaran::latest()->first();

        $anggotaKelas = AnggotaKelas::with([
            'siswa', 
            'kelas.waliKelas',
            'intrakulikuler.mapel',
            'kehadiran',
            'catatan',
            'amalanIbadahs'
        ])->findOrFail($decryptedId);

        $jenjang = preg_replace('/[^0-9]/', '', $anggotaKelas->kelas->rombel ?? '');
        $kelasSejenjangIds = Kelas::where('rombel', 'LIKE', '%' . $jenjang . '%')
            ->pluck('id');

        $listIntra = $anggotaKelas->intrakulikuler instanceof \Illuminate\Database\Eloquent\Collection
            ? $anggotaKelas->intrakulikuler
            : ($anggotaKelas->intrakulikuler ? collect([$anggotaKelas->intrakulikuler]) : collect());

        $mapelIdsTerisi = $listIntra->whereNotNull('nilai')->pluck('mapel_id');

        $mapelIntrakulikuler = Mapel::where('kategori', 'Intrakulikuler')
            ->whereIn('id', $mapelIdsTerisi)
            ->get();

        $mapelAmalanIbadah = Mapel::where('kategori', 'Amal Ibadah')->get();

        if ($anggotaKelas->intrakulikuler) {
            $listIntra = $anggotaKelas->intrakulikuler instanceof \Illuminate\Database\Eloquent\Collection
                ? $anggotaKelas->intrakulikuler
                : collect([$anggotaKelas->intrakulikuler]);

            foreach ($listIntra as $intra) {
                $dataDeskripsi = Deskripsi::where('mapel_id', $intra->mapel_id)
                    ->whereIn('kelas_id', $kelasSejenjangIds)
                    ->first();

                $capaian = $dataDeskripsi->deskripsi ?? '-';

                if (!is_numeric($intra->nilai) || $capaian === '-') {
                    $intra->deskripsi_otomatis = '-';
                } elseif ($intra->nilai <= 79) {
                    $intra->deskripsi_otomatis = 'Ananda sedang berkembang dalam ' . $capaian;
                } elseif ($intra->nilai <= 89) {
                    $intra->deskripsi_otomatis = 'Ananda sudah berkembang sesuai harapan dalam ' . $capaian;
                } elseif ($intra->nilai <= 100) {
                    $intra->deskripsi_otomatis = 'Ananda sangat berkembang dalam ' . $capaian;
                } else {
                    $intra->deskripsi_otomatis = '-';
                }
            }
        }

        $siswa = $anggotaKelas->siswa;

        $pdf = Pdf::loadView('pdf.rapot', compact(
            'anggotaKelas',
            'siswa',
            'kehadirans',
            'mapelIntrakulikuler',
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