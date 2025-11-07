<!DOCTYPE html>
<html>
<head>
    <title>Laporan Absensi Pegawai</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table {
            width:100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border:1px solid #000;
            padding:5px;
            text-align: left;
        }
        h2 { text-align: center; }
        .footer { margin-top: 20px; font-size: 11px; }
    </style>
</head>
<body>

<h2>Laporan Absensi Pegawai</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pegawai</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Waktu Absen</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $i => $absen)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $absen->pegawai->name ?? '-' }}</td>
            <td>{{ $absen->tanggal }}</td>
            <td>{{ ucfirst($absen->status) }}</td>
            <td>{{ $absen->created_at->format('H:i:s') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    Dicetak pada: {{ date('d-m-Y H:i') }}
</div>

</body>
</html>
