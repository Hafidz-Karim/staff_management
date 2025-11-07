<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Absensi Pegawai</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #000; }
        .header { text-align: center; margin-bottom: 6px; }
        .meta { text-align: center; font-size: 11px; color: #333; margin-bottom: 8px; }
        table { width:100%; border-collapse: collapse; margin-top: 6px; }
        table, th, td { border: 1px solid #000; }
        th { background: #f2f2f2; font-weight: bold; padding: 6px; text-align: center; }
        td { padding: 6px; vertical-align: top; }
        .right { text-align: right; }
        .small { font-size: 11px; color: #555; }
        @media print {
            /* nothing special needed; dompdf respects inline css */
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>LAPORAN ABSENSI PEGAWAI</h3>
        <div class="meta">
            {{-- Filter: Nama = "{{ request('nama') ?? 'Semua' }}" • Tanggal = "{{ request('tanggal') ?? 'Semua' }}"<br> --}}
            Dicetak: {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d-m-Y H:i') }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:4%;">No</th>
                <th style="width:28%;">Nama Pegawai</th>
                <th style="width:12%;">Tanggal</th>
                <th style="width:12%;">Hari</th>
                <th style="width:12%;">Jam Masuk</th>
                <th style="width:12%;">Jam Pulang</th>
                <th style="width:10%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($absensi as $row)
                <tr>
                    <td style="text-align:center;">{{ $loop->iteration }}</td>
                    <td>{{ $row->user->name ?? '-' }}</td>
                    <td style="text-align:center;">{{ $row->tanggal }}</td>
                    <td style="text-align:center;">{{ $row->hari ?? '-' }}</td>
                    <td style="text-align:center;">{{ $row->waktu_masuk ?? $row->jam_masuk ?? '-' }}</td>
                    <td style="text-align:center;">{{ $row->waktu_pulang ?? $row->jam_pulang ?? '-' }}</td>
                    <td style="text-align:center;">{{ ucfirst($row->status ?? '-') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:18px;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>
    <div class="small right">
        Total baris: {{ $summary['count'] ?? $absensi->count() ?? 0 }}
    </div>
</body>
</html>
