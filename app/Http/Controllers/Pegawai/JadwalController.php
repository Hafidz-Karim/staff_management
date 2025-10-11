<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\JadwalKerja;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        // ambil hanya jadwal milik pegawai yang login
        $jadwals = JadwalKerja::where('pegawai_id', Auth::id())
                    ->orderBy('tanggal','asc')
                    ->get();

        return view('pegawai.jadwal.index', compact('jadwals'));
    }
}
