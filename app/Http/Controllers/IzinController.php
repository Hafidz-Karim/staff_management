<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
{
    // =======================
    // FORM PENGAJUAN IZIN
    // =======================
    public function create()
    {
        return view('izin.create');
    }

    // =======================
    // SIMPAN PENGAJUAN IZIN
    // =======================
    public function store(Request $request)
    {
        $request->validate([
            'jenis_izin' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|min:5',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Menentukan jenis izin final (jika memilih "Lain Lain")
        $finalJenisIzin = $request->jenis_izin == 'Lain Lain'
            ? $request->jenis_izin_lainnya
            : $request->jenis_izin;

        // Upload file bukti jika ada
        $fileName = null;
        if ($request->hasFile('bukti')) {
            $fileName = time() . '_' . $request->bukti->getClientOriginalName();
            $request->bukti->move(public_path('uploads/izin'), $fileName);
        }

        // Simpan izin
        Izin::create([
            'user_id' => Auth::id(),
            'jenis_izin' => $finalJenisIzin,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
            'bukti' => $fileName,
            'status' => 'pending',
        ]);

        return redirect()->route('izin.index')->with('success', 'Pengajuan izin berhasil dikirim.');
    }

    // =======================
    // RIWAYAT IZIN
    // =======================
    public function index()
    {
        $izins = Izin::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('izin.index', compact('izins'));
    }

    // =======================
    // FORM EDIT IZIN
    // =======================
    public function edit($id)
    {
        $izin = Izin::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // hanya pending yang boleh edit
        if ($izin->status !== 'pending') {
            return back()->with('error', 'Izin yang sudah diverifikasi tidak dapat diubah.');
        }

        return view('izin.edit', compact('izin'));
    }

    // =======================
    // UPDATE IZIN
    // =======================
    public function update(Request $request, $id)
    {
        $izin = Izin::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($izin->status !== 'pending') {
            return back()->with('error', 'Izin yang sudah diverifikasi tidak dapat diubah.');
        }

        $request->validate([
            'jenis_izin' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|min:5',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Jika upload bukti baru
        if ($request->hasFile('bukti')) {
            $fileName = time() . '_' . $request->bukti->getClientOriginalName();
            $request->bukti->move(public_path('uploads/izin'), $fileName);
            $izin->bukti = $fileName;
        }

        $izin->jenis_izin = $request->jenis_izin;
        $izin->tanggal_mulai = $request->tanggal_mulai;
        $izin->tanggal_selesai = $request->tanggal_selesai;
        $izin->alasan = $request->alasan;
        $izin->save();

        return redirect()->route('izin.index')->with('success', 'Pengajuan izin berhasil diperbarui.');
    }

    // =======================
    // TAMPILKAN FILE BUKTI
    // =======================
    public function showSuratBukti($idIzin)
    {
        $izin = Izin::find($idIzin);
        return view('izin.showimage', compact('izin'));
    }
    //
    public function destroy($id)
    {
        $izin = Izin::where('id', $id)
            ->where('user_id', Auth::id()) // hanya boleh hapus izin miliknya
            ->firstOrFail();

        // Hanya boleh hapus kalau status masih pending
        if (strtolower($izin->status) !== 'pending') {
            return redirect()->back()->with('error', 'Izin tidak dapat dihapus karena sudah diproses.');
        }

        // Hapus file bukti jika ada
        if ($izin->bukti && file_exists(public_path('uploads/izin/' . $izin->bukti))) {
            unlink(public_path('uploads/izin/' . $izin->bukti));
        }

        // Hapus data izin
        $izin->delete();

        return redirect()->route('izin.index')->with('success', 'Pengajuan izin berhasil dihapus.');
    }
}
