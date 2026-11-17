<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ public_path('asset/raport.css') }}">
</head>
<body>

    <div class="kop-surat">
        <img src="{{ public_path('asset/cop.jpeg') }}" alt="Kop Surat">
    </div>
    <div class="garis-kop"></div>

    <div class="judul-laporan">
        LAPORAN PERKEMBANGAN PESERTA DIDIK<br>
        TENGAH SEMESTER GANJIL<br>
        TAHUN AJARAN {{ str_replace('/', '-', $tahunAjaranAktif->tahun_ajaran ?? '-') }}
    </div>

    <table class="identitas-siswa">
        <tr>
            <td class="label-col">Nama</td>
            <td class="separator-col">:</td>
            <td>{{ $anggotaKelas->siswa->nama_siswa ?? '-' }}</td>
        </tr>
        <tr>
            <td>NIS</td>
            <td>:</td>
            <td>{{ $anggotaKelas->siswa->nis ?? '-' }}</td>
        </tr>
        <tr>
            <td>NISN</td>
            <td>:</td>
            <td>{{ $anggotaKelas->siswa->nisn ?? '-' }}</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td>{{ $anggotaKelas->kelas->rombel ?? '-' }}</td>
        </tr>
    </table>
    
<div class="page-break"></div>

<div class="invoice-box">
    <div style="font-weight: bold; margin-bottom: 2px;">D. AMAL IBADAH</div>
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">
        <thead>
            <tr style="background: #ccc;">
                <th style="width: 10%; border: 1px solid black; padding: 4px; text-align: center;">NO</th>
                <th style="width: 35%; border: 1px solid black; padding: 4px; text-align: center;">JENIS AMAL IBADAH</th>
                <th style="width: 55%; border: 1px solid black; padding: 4px; text-align: center;">DESKRIPSI</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mapelAmalanIbadah ?? [] as $index => $mapel)
                <tr>
                    <td style="border: 1px solid black; padding: 4px; text-align: center;">{{ $index + 1 }}</td>
                    <td style="border: 1px solid black; padding: 4px;">{{ $mapel->mapel ?? '-' }}</td>
                    <td style="border: 1px solid black; padding: 4px; text-align: justify;">
                        {{ $mapel->deskripsi ?? '-' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="border: 1px solid black; padding: 4px; text-align: center;">Belum ada data amalan ibadah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="font-weight: bold; margin-bottom: 5px;">E. SARAN-SARAN</div>
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">
        <thead>
            <tr>
                <th style="background: #ccc; border: 1px solid black; padding: 4px; text-align: center;">KOMENTAR GURU</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid black; padding: 6px; height: 40px; vertical-align: top; text-align: justify;">
                    {{ $anggotaKelas->catatan->catatan ?? '-' }}
                </td>
            </tr>
            <tr>
                <th style="background: #ccc; border: 1px solid black; padding: 4px; text-align: center;">KOMENTAR ORANG TUA</th>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 6px; height: 50px; vertical-align: top;">
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 40%; border-collapse: collapse; border: 1px solid black; margin-bottom: 30px;">
        <thead>
            <tr>
                <th colspan="2" style="background: #ccc; text-align: center; border: 1px solid black; padding: 4px;">KETIDAKHADIRAN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid black; padding: 4px;">1. Sakit</td>
                <td style="text-align: center; border: 1px solid black; padding: 4px;">
                    {{ $anggotaKelas->kehadiran?->sakit ?? '-' }}
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 4px;">2. Izin</td>
                <td style="text-align: center; border: 1px solid black; padding: 4px;">
                    {{ $anggotaKelas->kehadiran?->izin ?? '-' }}
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 4px;">3. Alpa</td>
                <td style="text-align: center; border: 1px solid black; padding: 4px;">
                    {{ $anggotaKelas->kehadiran?->tanpa_keterangan ?? '-' }}
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border: none; margin-top: 20px; text-align: center;">
        <br>
        <br>
        <tr>
            <td style="width: 50%; vertical-align: top;">
                Mengetahui,<br>Orang Tua Siswa
                <br><br><br><br><br>
                <b>______________________</b>
            </td>
            <td style="width: 50%; vertical-align: top;">
                Garut, {{ isset($tahunAjaranAktif->titimangsa) ? \Carbon\Carbon::parse($tahunAjaranAktif->titimangsa)->locale('id')->translatedFormat('d F Y') : '11 Oktober 2024' }}<br>Wali Kelas
                <br><br><br><br><br>
                <b><u>{{ $anggotaKelas->kelas->waliKelas->nama_guru ?? '-' }}</u></b><br>
                NUPTK. {{ $anggotaKelas->kelas->waliKelas->nip ?? '-' }}
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center; padding-top: 30px;">
                Mengetahui,<br>Kepala Sekolah
                <br>Garut Islamic School Prima Insani
                <br><br><br><br><br>
                <b><u>{{ $tahunAjaranAktif->kepala_sekolah ?? '-' }}</u></b><br>
                NRKS. {{ $tahunAjaranAktif->nuptk ?? '-' }}
            </td>
        </tr>
    </table>
</div>

</body>
</html>