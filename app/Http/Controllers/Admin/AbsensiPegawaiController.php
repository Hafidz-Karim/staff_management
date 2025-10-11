<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbsensiPegawai;
use Illuminate\Http\Request;

class AbsensiPegawaiController extends Controller
{
    public function index()
    {
        // Ambil semua data absensi dengan relasi user
        $absensi = AbsensiPegawai::with('user')
            ->orderBy('tanggal', 'desc')
            ->get();

        // Statistik singkat
        $totalHadir = AbsensiPegawai::where('status', 'ontime')->count();
        $totalTerlambat = AbsensiPegawai::where('status', 'terlambat')->count();

        return view('admin.absensi.index', compact('absensi', 'totalHadir', 'totalTerlambat'));
    }
}
