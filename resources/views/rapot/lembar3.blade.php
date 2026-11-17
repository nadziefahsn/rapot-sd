<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rapot Lembar 3 - Ko Kurikuler & Mulok PAI</title>
    <style>
        body { 
            font-family: 'Times New Roman', Times, serif; 
            font-size: 12px; 
            line-height: 1.3; 
            margin: 20px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 15px; 
        }
        th, td { 
            border: 1px solid black; 
            padding: 6px 8px; 
            vertical-align: top; 
        }
        th { 
            text-align: center; 
            background-color: #f2f2f2; 
        }
        .section-title { 
            font-weight: bold; 
            margin-top: 15px; 
            margin-bottom: 5px; 
            font-size: 13px; 
        }
    </style>
</head>
<body>

    <!-- Bagian B: Ko Kurikuler dan Ekstrakurikuler -->
    <div class="section-title">B. KO KURIKULER DAN EKSTRAKURIKULER</div>
    <table>
        <thead>
            <tr>
                <th style="width: 10%;">NO</th>
                <th style="width: 30%;">KO KURIKULER DAN EKSTRAKURIKULER</th>
                <th style="width: 60%;">DESKRIPSI</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ekskuls as $index => $item)
                <tr>
                    <td align="center">{{ $index + 1 }}</td>
                    <td>{{ $item->nama_kegiatan }}</td>
                    <td>{{ $item->deskripsi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Bagian C: Mulok PAI Khas Prima Insani -->
    <div class="section-title">C. MULOK PAI KHAS PRIMA INSANI</div>
    <table>
        <thead>
            <tr>
                <th style="width: 10%;">NO</th>
                <th style="width: 30%;">MATERI</th>
                <th style="width: 60%;">DESKRIPSI</th>
            </tr>
        </thead>
        <tbody>
            @foreach($muloks as $index => $item)
                <tr>
                    <td align="center">{{ $index + 1 }}</td>
                    <td>{{ $item->nama_kegiatan }}</td>
                    <td>{{ $item->deskripsi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Kotak Catatan T2Q -->
    <table>
        <tr>
            <td style="width: 30%; text-align: center; font-weight: bold; vertical-align: middle;">Catatan T2Q</td>
            <td>Ibu/bapa guru terhadap pembiasaan baik ananda mengaji dan salat di sekolah dapat berdampak dan menjadi pembiasaan juga di rumah, semangat ananda sholeh sholehah semoga selalu istiqomah.</td>
        </tr>
    </table>

</body>
</html>