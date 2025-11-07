<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Laporan Absensi - {{ request('tanggal') ? request('tanggal') : 'Semua' }}</title>
  <style>
    /* Basic print styling */
    body { font-family: Arial, sans-serif; color: #000; margin: 20px; font-size: 12px; }
    .header { text-align:center; }
    .meta { margin-top: 8px; text-align: center; font-size: 12px; color: #333; }
    table { width:100%; border-collapse: collapse; margin-top: 16px; }
    th, td { border: 1px solid #444; padding: 6px 8px; text-align: left; vertical-align: middle; }
    th { background: #f2f2f2; }
    .small { font-size: 11px; color: #555; }
    .right { text-align: right; }

    /* hide print-only controls when printing */
    .no-print { margin-bottom: 10px; }
    @media print {
      .no-print { display: none; }
      /* ensure rows not break mid-cell */
      tr { page-break-inside: avoid; }
      thead { display: table-header-group; } /* reprint header on each page */
      tfoot { display: table-footer-group; }
    }

    /* optional page break classes */
    .page-break { page-break-after: always; }
  </style>
</head>
<body>
  <div class="header">
    <h2>Rekap Absensi Pegawai</h2>
    <div class="meta small">
      {{-- Filter: Nama = "{{ request('nama') ?? 'Semua' }}", Tanggal = "{{ request('tanggal') ?? 'Semua' }}" --}}
      <br>Dicetak: {{ \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d H:i') }}
    </div>

    <div class="no-print" style="text-align:center; margin-top:10px;">
      <button onclick="window.print()">🖨 Print</button>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th style="width: 30%;">Nama</th>
        <th style="width:12%;">Tanggal</th>
        <th style="width:12%;">Hari</th>
        <th style="width:12%;">Masuk</th>
        <th style="width:12%;">Pulang</th>
        <th style="width:12%;">Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse($absensis as $a)
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
          <td colspan="6" style="text-align:center; padding: 18px;">Tidak ada data.</td>
        </tr>
      @endforelse
    </tbody>
    <tfoot>
      <tr>
        <td colspan="6" class="small right">Total baris: {{ $summary['count'] ?? $absensis->count() }}</td>
      </tr>
    </tfoot>
  </table>

</body>
</html>
