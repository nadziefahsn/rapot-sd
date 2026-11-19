<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ public_path('asset/raport.css') }}">
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
        }

        table, th, td {
            font-family: "Times New Roman", Times, serif;
        }
    </style>
</head>
<body>

<div style="width: 100%; height: 100%; position: absolute; top: 0; left: 0; background-image: url('{{ $base64Cover }}'); background-size: cover; background-position: center; background-repeat: no-repeat; font-family: Tahoma, sans-serif; color: white; text-align: center;">        
    <div style="position: absolute; top: 85px; width: 100%; left: 0;">
            <div style="font-size: 16px; font-weight: bold; line-height: 1.3; text-transform: uppercase; letter-spacing: 0.5px;">
                LAPORAN PERKEMBANGAN PESERTA DIDIK<br>
                TENGAH SEMESTER GANJIL
            </div>
            <div style="font-size: 16px; font-weight: bold; line-height: 1.3; text-transform: uppercase; letter-spacing: 0.5px;">
                TAHUN AJARAN {{ str_replace('/', '-', $tahunAjaranAktif->tahun_ajaran ?? '-') }}
            </div>
        </div>

        <div style="position: absolute; top: 650px; width: 100%; left: 0;">
            <div style="font-size: 16px; font-weight: bold; margin-bottom: 2px;">Nama Peserta Didik:</div>
            <div style="font-size: 16px; font-weight: bold; margin-bottom: 12px;">{{ $anggotaKelas->siswa->nama_siswa ?? '-' }}</div>
            
            <div style="font-size: 16px; font-weight: bold; margin-bottom: 2px;">NIS/NISN:</div>
            <div style="font-size: 16px; font-weight: bold;">{{ $anggotaKelas->siswa->nis ?? '-' }}/{{ $anggotaKelas->siswa->nisn ?? '-' }}</div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="kop-surat">
        <img src="{{ public_path('asset/cop.jpeg') }}" alt="Kop Surat">
    </div>

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

    <div style="font-weight: bold; margin-bottom: 5px; font-size: 12px">A. INTRAKULIKULER</div>
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px; font-size: 12px">
        <thead>
            <tr style="background: #ccc;">
                <th style="width: 7%; border: 1px solid black; padding: 6px; text-align: center;">NO</th>
                <th style="width: 25%; border: 1px solid black; padding: 6px; text-align: center;">MATA PELAJARAN</th>
                <th style="width: 65%; border: 1px solid black; padding: 6px; text-align: center;">DESKRIPSI</th>
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
                    <td style="border: 1px solid black; padding: 6px; text-align: center; font-size: 12px">{{ $index + 1 }}</td>
                    <td style="border: 1px solid black; padding: 6px; font-size: 12px">{{ $mapel->mapel ?? '-' }}</td>
                    <td style="border: 1px solid black; padding: 6px; text-align: justify; font-size: 12px">{{ $deskripsiIntrakulikuler }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="border: 1px solid black; padding: 6px; text-align: center;">Belum ada data intrakulikuler.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="page-break"></div>

    <div style="font-weight: bold; margin-bottom: 5px; font-size: 12px;">C. MULOK PAI KHAS PRIMA INSANI</div>
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px; font-size: 12px;">
        <thead>
            <tr style="background: #ccc;">
                <th style="width: 7%; border: 1px solid black; padding: 6px 10px; text-align: center;">NO</th>
                <th style="width: 25%; border: 1px solid black; padding: 6px 10px; text-align: center;">MATERI</th>
                <th style="width: 65%; border: 1px solid black; padding: 6px 10px; text-align: center;">DESKRIPSI</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid black; padding: 6px 10px; text-align: center; font-weight: bold;">A</td>
                <td colspan="2" style="border: 1px solid black; padding: 6px 10px; font-weight: bold;">Pelajaran Salat</td>
            </tr>
            @forelse($mulokSholat ?? [] as $index => $mapel)
                <tr>
                    <td style="border: 1px solid black; padding: 6px 10px; text-align: center;">{{ $index + 1 }}.</td>
                    <td style="border: 1px solid black; padding: 6px 10px;">{{ $mapel->mapel ?? '-' }}</td>
                    <td style="border: 1px solid black; padding: 6px 10px; text-align: justify;">{{ $mapel->deskripsi ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="border: 1px solid black; padding: 6px 10px; text-align: center;">Belum ada data pelajaran salat.</td>
                </tr>
            @endforelse
            <tr>
                <td style="border: 1px solid black; padding: 6px 10px; text-align: center; font-weight: bold;">B</td>
                <td colspan="2" style="border: 1px solid black; padding: 6px 10px; font-weight: bold;">Tahsin dan Tahfidz Al-Quran</td>
            </tr>
            @forelse($mulokTahsinTahfidz ?? [] as $index => $mapel)
                <tr>
                    <td style="border: 1px solid black; padding: 6px 10px; text-align: center;">{{ $index + 1 }}.</td>
                    <td style="border: 1px solid black; padding: 6px 10px;">{{ $mapel->mapel ?? '-' }}</td>
                    <td style="border: 1px solid black; padding: 6px 10px; text-align: justify;">{{ $mapel->deskripsi ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="border: 1px solid black; padding: 6px 10px; text-align: center;">Belum ada data tahsin dan tahfidz.</td>
                </tr>
            @endforelse
            <tr>
                <td style="border: 1px solid black; padding: 6px 10px; text-align: center; font-weight: bold;">C</td>
                <td colspan="2" style="border: 1px solid black; padding: 6px 10px; font-weight: bold;">Hafalan</td>
            </tr>
            @forelse($mulokHafalan ?? [] as $index => $mapel)
                <tr>
                    <td style="border: 1px solid black; padding: 6px 10px; text-align: center;">{{ $index + 1 }}.</td>
                    <td style="border: 1px solid black; padding: 6px 10px;">{{ $mapel->mapel ?? '-' }}</td>
                    <td style="border: 1px solid black; padding: 6px 10px; text-align: justify;">{{ $mapel->deskripsi ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="border: 1px solid black; padding: 6px 10px; text-align: center;">Belum ada data hafalan.</td>
                </tr>
            @endforelse
            <tr>
                <td colspan="2" style="border: 1px solid black; padding: 6px 10px; text-align: center; font-weight: bold; vertical-align: middle;">Catatan T2Q</td>
                <td style="border: 1px solid black; padding: 6px 10px; text-align: justify; font-weight: bold; font-style: italic;">{{ $catatanT2q ?? '-' }}</td>
            </tr>
        </tbody>
    </table>
    <div class="page-break"></div>


<div style="font-weight: bold; margin-bottom: 5px; font-size: 12px;">D. AMALAN IBADAH</div>
<table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px; font-size: 12px;">
    <thead>
        <tr style="background: #ccc;">
            <th style="width: 7%; border: 1px solid black; padding: 6px 10px; text-align: center;">NO</th>
            <th style="width: 25%; border: 1px solid black; padding: 6px 10px; text-align: center;">JENIS AMAL IBADAH</th>
            <th style="width: 65%; border: 1px solid black; padding: 6px 10px; text-align: center;">DESKRIPSI</th>
        </tr>
    </thead>
    <tbody>
        @forelse($mapelAmalanIbadah ?? [] as $index => $mapel)
            <tr>
                <td style="border: 1px solid black; padding: 6px 10px; text-align: center;">{{ $index + 1 }}</td>
                <td style="border: 1px solid black; padding: 6px 10px;">{{ $mapel->mapel ?? '-' }}</td>
                <td style="border: 1px solid black; padding: 6px 10px; text-align: justify;">{{ $mapel->deskripsi ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" style="border: 1px solid black; padding: 6px 10px; text-align: center;">Belum ada data amalan ibadah.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div style="font-weight: bold; margin-bottom: 5px; font-size: 12px;">E. SARAN-SARAN</div>
<table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px; font-size: 12px;">
    <thead>
        <tr>
            <th style="background: #ccc; border: 1px solid black; padding: 6px 10px; text-align: center;">KOMENTAR GURU</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="border: 1px solid black; padding: 6px 10px; height: 40px; vertical-align: top; text-align: justify;">
                {{ $anggotaKelas->catatan->catatan ?? '-' }}
            </td>
        </tr>
        <tr>
            <th style="background: #ccc; border: 1px solid black; padding: 6px 10px; text-align: center;">KOMENTAR ORANG TUA</th>
        </tr>
        <tr>
            <td style="border: 1px solid black; padding: 6px 10px; height: 50px; vertical-align: top;"></td>
        </tr>
    </tbody>
</table>
<div style="height: 20px;"></div>
<table style="width: 40%; border-collapse: collapse; border: 1px solid black; margin-bottom: 30px; font-size: 12px;">
    <thead>
        <tr>
            <th colspan="2" style="background: #ccc; text-align: center; border: 1px solid black; padding: 6px 10px;">KETIDAKHADIRAN</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="border: 1px solid black; padding: 6px 10px;">1. Sakit</td>
            <td style="text-align: center; border: 1px solid black; padding: 6px 10px;">{{ $anggotaKelas->kehadiran?->sakit ?? '-' }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid black; padding: 6px 10px;">2. Izin</td>
            <td style="text-align: center; border: 1px solid black; padding: 6px 10px;">{{ $anggotaKelas->kehadiran?->izin ?? '-' }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid black; padding: 6px 10px;">3. Alpa</td>
            <td style="text-align: center; border: 1px solid black; padding: 6px 10px;">{{ $anggotaKelas->kehadiran?->tanpa_keterangan ?? '-' }}</td>
        </tr>
    </tbody>
</table>
<div style="height: 40px;"></div>
<table style="width: 100%; border: none; margin-top: 0; text-align: center; font-size: 12px;">    <tr>
        <td style="width: 50%; vertical-align: top; padding: 6px 10px;">
            Mengetahui,<br>Orang Tua Siswa
            <br><br><br><br><br>
            <b>______________________</b>
        </td>
        <td style="width: 50%; vertical-align: top; padding: 6px 10px;">
            Garut, {{ isset($tahunAjaranAktif->titimangsa) ? \Carbon\Carbon::parse($tahunAjaranAktif->titimangsa)->locale('id')->translatedFormat('d F Y') : '11 Oktober 2024' }}<br>Wali Kelas
            <br><br><br><br><br>
            <b><u>{{ $anggotaKelas->kelas->waliKelas->nama_guru ?? '-' }}</u></b><br>
            NUPTK. {{ $anggotaKelas->kelas->waliKelas->nip ?? '-' }}
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center; padding: 30px 10px 6px;">
            Mengetahui,<br>Kepala Sekolah
            <br>Garut Islamic School Prima Insani
            <br><br><br><br><br>
            <b><u>{{ $tahunAjaranAktif->kepala_sekolah ?? '-' }}</u></b><br>
            NRKS. {{ $tahunAjaranAktif->nuptk ?? '-' }}
        </td>
    </tr>
</table>
</body>
</html>