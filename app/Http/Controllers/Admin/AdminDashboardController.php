<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Hitung berdasarkan jenis (guru, pegawai, admin)
        $totalGuru = User::where('jenis', 'guru')->count();
        $totalPegawai = User::where('jenis', 'pegawai')->count();
        $totalAdmin = User::where('jenis', 'admin')->count();


        return view('admin.dashboard', compact(
            'totalGuru',
            'totalPegawai',
            'totalAdmin',
        ));
    }
}
