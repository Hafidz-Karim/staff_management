<?php

namespace App\Http\Controllers;

use App\Models\AbsensiPegawai;
use Illuminate\Http\Request;

class AbsensiPegawaiController extends Controller
{
    public function index()
    {
        $absensis = AbsensiPegawai::where('user_id', auth()->id())
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('absensipegawai.index', compact('absensis'));
    }

    public function store(Request $request)
    {
        $today = now()->toDateString();
        $existing = AbsensiPegawai::where('user_id', auth()->id())
            ->where('tanggal', $today)
            ->first();

        if (!$existing) {
            // Absen masuk
            $jamMasuk = now()->format('H:i:s');
            $status = $jamMasuk <= '07:30:00' ? 'ontime' : 'terlambat';

            AbsensiPegawai::create([
                'user_id' => auth()->id(),
                'tanggal' => $today,
                'waktu_masuk' => $jamMasuk,
                'status' => $status,
            ]);

            return back()->with('success', 'Absen masuk berhasil!');
        } else {
            // Absen pulang
            if (!$existing->waktu_pulang) {
                $existing->update(['waktu_pulang' => now()->format('H:i:s')]);
                return back()->with('success', 'Absen pulang berhasil!');
            } else {
                return back()->with('info', 'Kamu sudah absen pulang hari ini.');
            }
        }
    }
}
