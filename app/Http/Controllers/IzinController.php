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

    // SIMPAN PENGAJUAN IZIN
    public function store(Request $request)
    {
        $request->validate([
            'jenis_izin' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|min:5',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Tentukan jenis izin final
        $finalJenisIzin = $request->jenis_izin == 'Lain Lain'
            ? $request->jenis_izin_lainnya
            : $request->jenis_izin;

        // Upload file bukti bila ada
        $fileName = null;
        if ($request->hasFile('bukti')) {
            $fileName = time().'_'.$request->bukti->getClientOriginalName();
            $request->bukti->move(public_path('uploads/izin'), $fileName);
        }

        // Simpan data izin (DISAMAKAN DENGAN DATABASE)
        Izin::create([
            'user_id' => Auth::id(),
            'jenis_izin' => $finalJenisIzin,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,     // ← sesuai database
            'bukti' => $fileName,             // ← sesuai database
            'status' => 'pending',
        ]);

        return redirect()->route('izin.index')->with('success', 'Pengajuan izin berhasil dikirim.');
    }

    // RIWAYAT IZIN
    public function index()
    {
        $izins = Izin::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('izin.index', compact('izins'));
    }

    // TAMPILKAN FILE
    public function showSuratBukti($idIzin)
    {
        $izin = Izin::find($idIzin);
        return view('izin.showimage', compact('izin'));
    }
}
