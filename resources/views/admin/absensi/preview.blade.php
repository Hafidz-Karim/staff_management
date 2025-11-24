<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Absensi Pegawai</title>

    <style>
        /* ====== STYLE DASAR HALAMAN ====== */
        body {
            background: #f3f4f6;
            font-family: "Times New Roman", serif;
            margin: 0;
            padding: 20px;
        }

        /* ==== WRAPPER CARD (MELAYANG) ==== */
        .container {
            max-width: 900px;
            background: white;
            margin: auto;
            padding: 25px 35px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1); /* efek melayang */
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
            font-size: 20pt;
        }

        .line {
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
            width: 100%;
        }

        /* ===== TOMBOL ===== */
        .buttons {
            margin-bottom: 20px;
            text-align: right;
        }

        .buttons a,
        .buttons button {
            background: #2563eb;
            color: white;
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            margin-left: 5px;
            cursor: pointer;
            font-size: 12pt;
        }

        .buttons a.download {
            background: #31ec2a;
        }

        /* ===== TABEL ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 12pt;
        }

        th, td {
            border: 1px solid #000;
            padding: 7px 8px;
            text-align: center;
        }

        th {
            background: #e6e6e6;
            font-weight: bold;
        }

        /* ===== PRINT MODE ===== */
        @media print {
            body {
                background: white !important;
                margin: 0;
                padding: 0;
            }

            .container {
                box-shadow: none !important;
                border-radius: 0;
                padding: 0;
                margin: 0;
            }

            .buttons {
                display: none;
            }

            @page {
                size: A4;
                margin: 15mm;
            }
        }
    </style>
</head>
<body>

    <div class="container">

        <h2>LAPORAN ABSENSI PEGAWAI</h2>
        <div class="line"></div>



        <!-- TABEL ABSENSI -->
        <table>
            <thead>
                <tr>
                    <th>Nama Pegawai</th>
                    <th>Tanggal</th>
                    <th>Hari</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($absensi as $a)
                    <tr>
                        <td>{{ $a->user->name ?? '-' }}</td>
                        <td>{{ $a->tanggal }}</td>
                        <td>{{ $a->hari }}</td>
                        <td>{{ $a->waktu_masuk ?? '-' }}</td>
                        <td>{{ $a->waktu_pulang ?? '-' }}</td>
                        <td>{{ ucfirst($a->status ?? '-') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Tidak ada data absensi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- RINGKASAN -->
        <p style="margin-top: 15px; font-size: 13pt;">
            <strong>Total Kehadiran:</strong> {{ $summary['count'] }}
        </p>
          <!-- TOMBOL -->
        <div class="buttons">
            <button onclick="window.print()"><i class="ri-printer-line"></i> Print</button>
            <a href="{{ route('admin.absensi.export-pdf', request()->query()) }}" class="download">
                <i class="ri-file-download-fill"></i> Download
            </a>
        </div>
    </div>

</body>
</html>
