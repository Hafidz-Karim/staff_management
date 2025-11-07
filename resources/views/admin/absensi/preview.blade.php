<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Absensi Pegawai</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .buttons { margin-bottom: 20px; }
        .buttons a, .buttons button {
            background: #2563eb; color: white; padding: 8px 14px;
            border: none; border-radius: 5px; text-decoration: none;
            margin-right: 10px; cursor: pointer;
        }
        .buttons a.download { background: #dc2626; }
        @media print { .buttons { display: none; } }
    </style>
</head>
<body>

    <h2 style="text-align:center;">Laporan Absensi Pegawai</h2>

    <div class="buttons">
        <button onclick="window.print()"><i class="ri-printer-line"></i> Print Laporan</button>
        <a href="{{ route('admin.absensi.export-pdf', request()->query()) }}" class="download"><i class="ri-file-download-fill"></i> Download PDF</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Pegawai</th>
                <th>Tanggal</th>
                <th>Hari</th>
                <th>Masuk</th>
                <th>Pulang</th>
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
                <tr><td colspan="6">Tidak ada data absensi</td></tr>
            @endforelse
        </tbody>
    </table>

    <p><strong>Total Kehadiran:</strong> {{ $summary['count'] }}</p>

</body>
</html>
