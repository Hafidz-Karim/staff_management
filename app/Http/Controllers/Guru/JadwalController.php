<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\JadwalMengajar;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
       $jadwals = \App\Models\JadwalMengajar::where('guru_id', auth()->id())->get();
        return view('guru.jadwal', compact('jadwals'));
    }
}
