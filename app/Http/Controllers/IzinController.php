<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
{
    // FORM PENGAJUAN IZIN
    public function create()
    {
        return view('izin.create');
    }

    // SIMPAN PENGAJUAN
    public function store(Request $request)
    {
        $request->validate([
            'jenis_izin' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|min:5',
            'bukti' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti_izin', 'public');
        }

        Izin::create([
            'user_id' => Auth::id(),
            'jenis_izin' => $request->jenis_izin,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
            'bukti' => $path,
            'status' => 'pending', // sesuai ENUM di database
        ]);

        return redirect()->route('izin.index')->with('success', 'Pengajuan izin berhasil dikirim.');
    }

    // RIWAYAT IZIN USER
    public function index()
    {
        // Ambil semua pengajuan user saat ini
        $izins = Izin::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('izin.index', compact('izins')); // nama variabel sama dengan Blade
    }

    public function showSuratBukti($idIzin) {
        $izin = Izin::find($idIzin);
        return view('izin.showimage', compact('izin'));
    }
}
