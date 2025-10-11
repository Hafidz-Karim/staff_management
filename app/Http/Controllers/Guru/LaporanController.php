<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanHarian;

class LaporanController extends Controller
{
    /**
     * Tampilkan semua laporan harian milik guru login
     */
    public function index()
    {
        // ambil semua laporan berdasarkan guru yang login
        $laporan = LaporanHarian::where('guru_id', auth()->id())->latest()->get();

        return view('guru.laporan.index', compact('laporan'));
    }

    /**
     * Form tambah laporan
     */
    public function create()
    {
        return view('guru.laporan.create');
    }

    /**
     * Simpan laporan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kelas' => 'required|string',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'materi' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        LaporanHarian::create([
            'guru_id' => auth()->id(),
            'tanggal' => $request->tanggal,
            'kelas' => $request->kelas,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'materi' => $request->materi,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('guru.laporan.index')->with('success', 'Laporan berhasil ditambahkan');
    }

    /**
     * Form edit laporan
     */
    public function edit(LaporanHarian $laporan)
    {
        // pastikan hanya guru pemilik laporan yang bisa edit
        if ($laporan->guru_id !== auth()->id()) {
            abort(403);
        }

        return view('guru.laporan.edit', compact('laporan'));
    }

    /**
     * Update laporan
     */
    public function update(Request $request, LaporanHarian $laporan)
    {
        if ($laporan->guru_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'tanggal' => 'required|date',
            'kelas' => 'required|string',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'materi' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        $laporan->update([
            'tanggal' => $request->tanggal,
            'kelas' => $request->kelas,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'materi' => $request->materi,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('guru.laporan.index')->with('success', 'Laporan berhasil diperbarui');
    }

    /**
     * Hapus laporan
     */
    public function destroy(LaporanHarian $laporan)
    {
        if ($laporan->guru_id !== auth()->id()) {
            abort(403);
        }

        $laporan->delete();

        return redirect()->route('guru.laporan.index')->with('success', 'Laporan berhasil dihapus');
    }
}
