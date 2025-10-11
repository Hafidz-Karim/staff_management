<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\JadwalKerja;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    public function index()
    {
        // Ambil jadwal milik pegawai yang login
        $jadwals = JadwalKerja::where('pegawai_id', Auth::id())
                    ->orderBy('tanggal','asc')
                    ->get();

        // Pastikan view ada: resources/views/pegawai/jadwal/index.blade.php
        return view('pegawai.jadwal.index', compact('jadwals'));
    }
}
