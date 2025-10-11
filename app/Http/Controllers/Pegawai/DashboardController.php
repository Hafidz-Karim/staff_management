<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalKerja;

class DashboardController extends Controller
{
    public function index()
    {
        // Contoh: statistik untuk pegawai
        $totalJadwal = JadwalKerja::where('pegawai_id', auth()->id())->count();

        return view('pegawai.dashboard', compact('totalJadwal'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('pegawai.profile', compact('user'));
    }
}
