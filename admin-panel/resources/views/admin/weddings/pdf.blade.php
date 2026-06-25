<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan RSVP {{ $wedding->nama_pria }} & {{ $wedding->nama_wanita }}</title>
    <style>
        /* Pengaturan Dasar Kertas */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333333;
            line-height: 1.4;
            font-size: 12px;
        }
        
        /* Header Laporan */
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #5c4d3c;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            color: #4a3b2c;
            font-size: 22px;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #777777;
            font-size: 12px;
        }

        /* Informasi Detail Pernikahan */
        .info-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 4px 0;
            vertical-align: top;
        }
        .info-table td.label {
            width: 25%;
            font-weight: bold;
            color: #5c4d3c;
        }

        /* Tabel Data Tamu */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .data-table th {
            background-color: #6b5843;
            color: #ffffff;
            padding: 8px 10px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
        }
        .data-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #dddddd;
            vertical-align: top;
        }
        .data-table tr:nth-child(even) {
            background-color: #f9f6f2;
        }

        /* Badge Status Kehadiran */
        .badge {
            display: inline-block;
            padding: 3px 7px;
            font-size: 10px;
            font-weight: bold;
            border-radius: 3px;
            text-align: center;
        }
        .badge-hadir {
            background-color: #d1fae5;
            color: #065f46;
        }
        .badge-absen {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 10px;
            color: #aaaaaa;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN DATA TAMU & UCAPAN</h2>
        <p>Layanan Undangan Digital Pernikahan • NantiKita</p>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Nama Pasangan</td>
            <td>: {{ $wedding->nama_pria }} & {{ $wedding->nama_wanita }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Acara</td>
            <td>: {{ \Carbon\Carbon::parse($wedding->tanggal_acara)->translatedFormat('l, d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Total Respon Tamu</td>
            <td>: {{ $rsvps->count() }} Orang</td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 25%;">Nama Tamu</th>
                <th style="width: 20%;">Alamat</th>
                <th style="width: 15%; text-align: center;">Konfirmasi</th>
                <th style="width: 10%; text-align: center;">Jumlah</th>
                <th style="width: 30%;">Ucapan & Doa Restu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rsvps as $index => $rsvp)
                <tr>
                    <td style="font-weight: bold;">{{ $rsvp->nama_tamu }}</td>
                    <td>{{ $rsvp->alamat ?? '-' }}</td>
                    <td style="text-align: center;">
                        @if($rsvp->status == 'hadir')
                            <span class="badge badge-hadir">Hadir</span>
                        @else
                            <span class="badge badge-absen">Absen</span>
                        @endif
                    </td>
                    <td style="text-align: center;">{{ $rsvp->jumlah_hadir }}</td>
                    <td style="font-style: italic;">"{{ $rsvp->ucapan ?? 'Memberikan doa restu.' }}"</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #999999; padding: 20px;">
                        Belum ada data konfirmasi kehadiran dari tamu undangan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Document generated automatically by NantiKita Panel on {{ now()->translatedFormat('d F Y, H:i') }} WIB
    </div>

</body>
</html>
