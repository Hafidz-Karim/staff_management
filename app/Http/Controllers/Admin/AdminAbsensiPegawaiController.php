<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsensiPegawai;
use PDF;

class AdminAbsensiPegawaiController extends Controller
{
    /**
     * FILTER UTAMA — Digunakan oleh INDEX, PREVIEW, dan PDF
     */
    private function applyFilters($query, Request $request)
    {
        // Filter berdasarkan nama pegawai
        if ($request->filled('nama')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->nama . '%');
            });
        }

        // Filter berdasarkan tanggal lengkap (tahun otomatis saat ini)
        if ($request->filled('tanggal') && $request->filled('bulan')) {
            $fullDate = now()->year . '-' . $request->bulan . '-' . $request->tanggal;
            $query->whereDate('tanggal', $fullDate);
            return; // tanggal lebih spesifik, hentikan filter lain
        }

        // Filter hanya bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan)
                  ->whereYear('tanggal', now()->year);
        }
    }


    /**
     * ==============================
     * HALAMAN INDEX (TAMPILAN TABLE)
     * ==============================
     */
    public function index(Request $request)
    {
        $query = AbsensiPegawai::with('user')->orderBy('tanggal', 'desc');

        $this->applyFilters($query, $request);

        $absensi = $query->paginate(10)->appends($request->except('page'));

        $filters = $request->only(['nama', 'tanggal', 'bulan']);

        return view('admin.absensi.index', compact('absensi', 'filters'));
    }


    /**
     * ==============================
     * HALAMAN PREVIEW (PRINT VIEW)
     * ==============================
     */
    public function preview(Request $request)
    {
        $query = AbsensiPegawai::with('user')->orderBy('tanggal', 'desc');

        $this->applyFilters($query, $request);

        $absensi = $query->get();

        $summary = [
            'count' => $absensi->count(),
        ];

        return view('admin.absensi.preview', compact('absensi', 'summary'));
    }


    /**
     * ==============================
     * EXPORT PDF
     * ==============================
     */
    public function exportPDF(Request $request)
    {
        $query = AbsensiPegawai::with('user')->orderBy('tanggal', 'desc');

        $this->applyFilters($query, $request);

        $absensi = $query->get();

        $summary = [
            'count' => $absensi->count(),
        ];

        $pdf = PDF::loadView('admin.absensi.export_pdf', [
            'absensi' => $absensi,
            'summary' => $summary
        ])->setPaper('A4', 'portrait');

        return $pdf->download('laporan_absensi_pegawai.pdf');
    }
}
