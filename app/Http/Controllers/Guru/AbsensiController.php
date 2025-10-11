<?php

namespace App\Http\Controllers\Guru;
use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Tampilkan daftar absensi
     */
    public function index()
    {
     $absensis = Absensi::with('siswa')->get();
        return view('guru.absensi.index', compact('absensis'));
    }

    /**
     * Form tambah absensi
     */
    public function create()
    {
        $siswas = \App\Models\Siswa::all(); // ambil semua siswa
        return view('guru.absensi.create', compact('siswas'));
    }

    /**
     * Simpan absensi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal'  => 'required|date',
            'status'   => 'required|in:hadir,izin,sakit,alpa',
        ]);

        Absensi::create([
            'siswa_id' => $request->siswa_id,
            'guru_id'  => auth()->id(),
            'tanggal'  => $request->tanggal,
            'status'   => $request->status,
        ]);

        return redirect()->route('guru.absensi.index')->with('success', 'Absensi berhasil ditambahkan.');
    }

    /**
     * Form edit absensi
     */
    public function edit($id)
    {
        $absensi = Absensi::findOrFail($id);
        $siswas = Siswa::all();

        return view('guru.absensi.edit', compact('absensi', 'siswas'));
    }

    /**
     * Update absensi
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal'  => 'required|date',
            'status'   => 'required|in:hadir,izin,sakit,alpa',
        ]);

        $absensi = Absensi::findOrFail($id);
        $absensi->update([
            'siswa_id' => $request->siswa_id,
            'guru_id'  => auth()->id(),
            'tanggal'  => $request->tanggal,
            'status'   => $request->status,
        ]);

        return redirect()->route('guru.absensi.index')->with('success', 'Absensi berhasil diperbarui.');
    }

    /**
     * Hapus absensi
     */
    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();

        return redirect()->route('guru.absensi.index')->with('success', 'Absensi berhasil dihapus.');
    }
}
