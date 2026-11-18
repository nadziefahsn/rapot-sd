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

        return $this->show($anggotaKelasId);
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

        if ($anggotaKelas->intrakulikuler) {
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

        $mapelAmalanIbadah = Mapel::where('kategori', 'Amal Ibadah')->get();

        foreach ($mapelAmalanIbadah as $mapel) {
            $itemAmalan = $anggotaKelas->amalanIbadahs->first(function ($ai) use ($mapel) {
                return $ai->mapel_id == $mapel->id;
            });

            $nilaiAngka = $itemAmalan ? (int) $itemAmalan->nilai : 0;
            $namaMapelLower = strtolower($mapel->mapel ?? $mapel->nama_mapel ?? '');

            if (str_contains($namaMapelLower, 'salat') || str_contains($namaMapelLower, 'sholat')) {
                if ($nilaiAngka <= 81) {
                    $mapel->deskripsi = "Salat 5 waktu harus dimotivasi agar menjadi kebiasaan.";
                } elseif ($nilaiAngka <= 93) {
                    $mapel->deskripsi = "Salat sudah mulai berkembang dan perlu peningkatan agar menjadi kebiasaan.";
                } else {
                    $mapel->deskripsi = "Salat sudah menjadi kebiasaan semoga selalu istiqamah dalam beribadah.";
                }
            } elseif (str_contains($namaMapelLower, 'tilawah')) {
                if ($nilaiAngka <= 81) {
                    $mapel->deskripsi = "Tilawah harus dimotivasi agar menjadi kebiasaan.";
                } elseif ($nilaiAngka <= 93) {
                    $mapel->deskripsi = "Tilawah sudah mulai berkembang dan perlu peningkatan agar menjadi kebiasaan.";
                } else {
                    $mapel->deskripsi = "Tilawah sudah menjadi kebiasaan semoga selalu istiqamah dalam beribadah.";
                }
            } else {
                $mapel->deskripsi = $itemAmalan ? $itemAmalan->nilai : '-';
            }
        }

        $siswa = $anggotaKelas->siswa;

        $pathCover = public_path('asset/cover.sd.jpeg');
        $typeCover = pathinfo($pathCover, PATHINFO_EXTENSION);
        $dataCover = file_exists($pathCover) ? file_get_contents($pathCover) : '';
        $base64Cover = 'data:image/' . $typeCover . ';base64,' . base64_encode($dataCover);

        $pdf = Pdf::loadView('pdf.rapot', compact(
            'anggotaKelas',
            'siswa',
            'kehadirans',
            'mapelIntrakulikuler',
            'catatan',
            'mapelAmalanIbadah',
            'tahunAjaranAktif',
            'base64Cover'
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