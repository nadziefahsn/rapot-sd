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
            <td class="label-col"><b>Nama</b></td>
            <td class="separator-col"><b>:</b></td>
            <td><b>{{ $anggotaKelas->siswa->nama_siswa ?? '-' }}</b></td>
        </tr>
        <tr>
            <td><b>NIS</b></td>
            <td><b>:</b></td>
            <td><b>{{ $anggotaKelas->siswa->nis ?? '-' }}</b></td>
        </tr>
        <tr>
            <td><b>NISN</b></td>
            <td><b>:</b></td>
            <td><b>{{ $anggotaKelas->siswa->nisn ?? '-' }}</b></td>
        </tr>
        <tr>
            <td><b>Kelas</b></td>
            <td><b>:</b></td>
            <td><b>{{ $anggotaKelas->kelas->rombel ?? '-' }}</b></td>
        </tr>
    </table>

<div class="invoice-box">
    <div style="font-weight: bold; margin-bottom: 5px;">A. INTRAKULIKULER</div>
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">
        <thead>
            <tr style="background: #ccc;">
                <th style="width: 10%; border: 1px solid black; padding: 6px; text-align: center;">NO</th>
                <th style="width: 45%; border: 1px solid black; padding: 6px; text-align: center;">MATA PELAJARAN</th>
                <th style="width: 45%; border: 1px solid black; padding: 6px; text-align: center;">DESKRIPSI</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mapelIntrakulikuler ?? [] as $index => $mapel)
                @php
                    $itemIntrakulikuler = $anggotaKelas?->intrakulikuler?->first(function($intra) use ($mapel) {
                        return $intra->mapel_id == $mapel->id;
                    });
                    $deskripsiIntrakulikuler = $itemIntrakulikuler ? $itemIntrakulikuler->deskripsi_otomatis : '-';
                @endphp
                <tr>
                    <td style="border: 1px solid black; padding: 6px; text-align: center;">{{ $index + 1 }}</td>
                    <td style="border: 1px solid black; padding: 6px;">{{ $mapel->mapel ?? '-' }}</td>
                    <td style="border: 1px solid black; padding: 6px; text-align: justify;">{{ $deskripsiIntrakulikuler }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="border: 1px solid black; padding: 6px; text-align: center;">Belum ada data intrakulikuler.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
<div class="page-break"></div>


<div class="invoice-box">
    <div style="font-weight: bold; margin-bottom: 5px;">A. AMAL IBADAH</div>
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">
        <thead>
            <tr style="background: #ccc;">
                <th style="width: 10%; border: 1px solid black; padding: 6px; text-align: center;">NO</th>
                <th style="width: 45%; border: 1px solid black; padding: 6px; text-align: center;">JENIS AMAL IBADAH</th>
                <th style="width: 45%; border: 1px solid black; padding: 6px; text-align: center;">DESKRIPSI / NILAI</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mapelAmalanIbadah ?? [] as $index => $mapel)
                @php
                    $itemAmalan = $anggotaKelas?->amalanIbadahs?->first(function($ai) use ($mapel) {
                        return $ai->mapel_id == $mapel->id;
                    });
                    $nilaiAmalan = $itemAmalan ? $itemAmalan->nilai : '-';
                @endphp
                <tr>
                    <td style="border: 1px solid black; padding: 6px; text-align: center;">{{ $index + 1 }}</td>
                    <td style="border: 1px solid black; padding: 6px;">{{ $mapel->mapel ?? '-' }}</td>
                    <td style="border: 1px solid black; padding: 6px; text-align: center;">{{ $nilaiAmalan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="border: 1px solid black; padding: 6px; text-align: center;">Belum ada data amalan ibadah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="font-weight: bold; margin-bottom: 5px;">E. SARAN-SARAN</div>
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">
        <thead>
            <tr>
                <th style="background: #ccc; border: 1px solid black; padding: 6px; text-align: center;">KOMENTAR GURU</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid black; padding: 10px; height: 50px; vertical-align: top; text-align: justify;">
                    {{ $anggotaKelas->catatan->catatan ?? '-' }}
                </td>
            </tr>
            <tr>
                <th style="background: #ccc; border: 1px solid black; padding: 6px; text-align: center;">KOMENTAR ORANG TUA</th>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 10px; height: 60px; vertical-align: top;">
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 40%; border-collapse: collapse; border: 1px solid black; margin-bottom: 30px;">
        <thead>
            <tr>
                <th colspan="2" style="background: #ccc; text-align: center; border: 1px solid black; padding: 6px;">KETIDAKHADIRAN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid black; padding: 5px;">1. Sakit</td>
                <td style="text-align: center; border: 1px solid black; padding: 5px;">
                    {{ $anggotaKelas->kehadiran?->sakit ?? '-' }}
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 5px;">2. Izin</td>
                <td style="text-align: center; border: 1px solid black; padding: 5px;">
                    {{ $anggotaKelas->kehadiran?->izin ?? '-' }}
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 5px;">3. Alpa</td>
                <td style="text-align: center; border: 1px solid black; padding: 5px;">
                    {{ $anggotaKelas->kehadiran?->tanpa_keterangan ?? '-' }}
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border: none; margin-top: 20px; text-align: center;">
        <br>
        <br>
        <br>
        <tr>
            <td style="width: 50%; vertical-align: top;">
                Mengetahui,<br>Orang Tua Siswa
                <br><br><br><br>
                <b>______________________</b>
            </td>
            <td style="width: 50%; vertical-align: top;">
                Garut, {{ isset($tahunAjaranAktif->titimangsa) ? \Carbon\Carbon::parse($tahunAjaranAktif->titimangsa)->locale('id')->translatedFormat('d F Y') : '11 Oktober 2024' }}<br>Wali Kelas
                <br><br><br><br>
                <b><u>{{ $anggotaKelas->kelas->waliKelas->nama_guru ?? '-' }}</u></b><br>
                NUPTK. {{ $anggotaKelas->kelas->waliKelas->nip ?? '-' }}
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center; padding-top: 30px;">
                Mengetahui,<br>Kepala Sekolah
                <br><br><br><br>
                <b><u>{{ $tahunAjaranAktif->kepala_sekolah ?? '-' }}</u></b><br>
                NUPTK. {{ $tahunAjaranAktif->nuptk ?? '-' }}
            </td>
        </tr>
    </table>
</div>