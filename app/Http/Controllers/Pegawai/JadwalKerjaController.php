<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\JadwalKerja;

class JadwalKerjaController extends Controller
{
    public function index()
    {
        $jadwals = JadwalKerja::where('pegawai_id', auth()->id())
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('pegawai.jadwal.index', compact('jadwals'));
    }
}
