<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbsensiPegawai;
use App\Models\User;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua absensi dengan relasi user-nya
        $absensis = AbsensiPegawai::with('user')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.absensi.index', compact('absensis'));
    }
}
