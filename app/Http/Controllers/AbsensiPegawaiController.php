<?php

namespace App\Http\Controllers;

use App\Models\AbsensiPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiPegawaiController extends Controller
{
    public function index()
    {
        $absensis = AbsensiPegawai::where('user_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('absensipegawai.index', compact('absensis'));
    }

    public function store(Request $request)
    {
        // Gunakan zona waktu Jakarta
        $now = Carbon::now('Asia/Jakarta');
        $today = $now->toDateString();

        // --- pastikan locale Indonesia aktif ---
        $now->locale('id');

        // --- mapping manual (fallback jika locale gagal) ---
        $days = [
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
            'Sunday'    => 'Minggu',
        ];

        // Dapatkan nama hari dalam bahasa Indonesia
        $hariInggris = $now->format('l');
        $hari = $days[$hariInggris] ?? $now->translatedFormat('l');

        // Cek apakah sudah absen hari ini
        $existing = AbsensiPegawai::where('user_id', Auth::id())
            ->where('tanggal', $today)
            ->first();

        // --- Absen Masuk ---
        if (!$existing) {
            $jamMasuk = $now->format('H:i:s');
            $status = $this->getStatus($now);

            AbsensiPegawai::create([
                'user_id'     => Auth::id(),
                'tanggal'     => $today,
                'hari'        => $hari,
                'waktu_masuk' => $jamMasuk,
                'status'      => $status,
            ]);

            return back()->with('success', "Absen masuk berhasil dicatat untuk hari $hari!");
        }

        // --- Absen Pulang ---
        if (!$existing->waktu_pulang) {
            $batasPulang = Carbon::createFromTime(14, 0, 0, 'Asia/Jakarta');

            if ($now->lessThan($batasPulang)) {
                return back()->with('error', 'Belum waktunya absen pulang! (Minimal jam 14:00 WIB)');
            }

            $existing->update(['waktu_pulang' => $now->format('H:i:s')]);
            return back()->with('success', "Absen pulang berhasil dicatat untuk hari $hari!");
        }

        return back()->with('info', 'Kamu sudah melakukan absen pulang hari ini.');
    }

    /**
     * Menentukan status absensi (ontime / terlambat)
     */
    private function getStatus(Carbon $waktu)
    {
        $batasWaktu = Carbon::createFromTime(7, 30, 0, 'Asia/Jakarta');
        return $waktu->lessThanOrEqualTo($batasWaktu) ? 'ontime' : 'terlambat';
    }
}
