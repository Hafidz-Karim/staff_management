<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbsensiPegawai;
use Illuminate\Http\Request;
use PDF; // pastikan sudah di-import

class AdminAbsensiPegawaiController extends Controller
{
    // ✅ INDEX
    public function index(Request $request)
    {
        $query = AbsensiPegawai::with('user')->orderBy('tanggal', 'desc');

        if ($request->filled('nama')) {
            $query->whereHas('user', fn($q) =>
                $q->where('name', 'like', '%' . $request->nama . '%')
            );
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $absensi = $query->paginate(10)->withQueryString();
        return view('admin.absensi.index', compact('absensi'));
    }

    // ✅ PREVIEW LAPORAN (tampilan di browser sebelum download)
    public function preview(Request $request)
    {
        $query = AbsensiPegawai::with('user')->orderBy('tanggal', 'desc');

        if ($request->filled('nama')) {
            $query->whereHas('user', fn($q) =>
                $q->where('name', 'like', '%' . $request->nama . '%')
            );
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $absensi = $query->get();

        $summary = [
            'count' => $absensi->count(),
        ];

        // 🔹 tampilkan halaman preview
        return view('admin.absensi.preview', compact('absensi', 'summary'));
    }

    // ✅ EXPORT PDF (untuk tombol Download)
    public function exportPDF(Request $request)
    {
        $query = AbsensiPegawai::with('user')->orderBy('tanggal', 'desc');

        if ($request->filled('nama')) {
            $query->whereHas('user', fn($q) =>
                $q->where('name', 'like', '%' . $request->nama . '%')
            );
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $absensi = $query->get();

        $summary = [
            'count' => $absensi->count(),
        ];

        // 🔹 generate PDF dari view khusus
        $pdf = PDF::loadView('admin.absensi.export_pdf', [
            'absensi' => $absensi,
            'summary' => $summary
        ])->setPaper('A4', 'portrait');

        // 🔹 download file PDF
        return $pdf->download('laporan_absensi_pegawai.pdf');
    }
}
