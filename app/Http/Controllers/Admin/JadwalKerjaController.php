<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalKerja;
use App\Models\User; // Pegawai adalah user
use Illuminate\Http\Request;

class JadwalKerjaController extends Controller
{
    public function index()
    {
        // Ambil semua jadwal kerja beserta data pegawai
        $jadwals = JadwalKerja::with('pegawai')->orderBy('tanggal', 'asc')->get();
        return view('admin.jadwal_kerja.index', compact('jadwals'));
    }

    public function create()
    {
        // Ambil semua pegawai dari tabel users
        $users = User::all();
        return view('admin.jadwal_kerja.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id'   => 'required|exists:users,id',
            'hari'         => 'required|string|max:50',
            'tanggal'      => 'required|date',
            'jam_mulai'    => 'required|date_format:H:i',
            'jam_selesai'  => 'required|date_format:H:i|after:jam_mulai',
            'kegiatan'     => 'nullable|string',
        ]);

        JadwalKerja::create([
            'pegawai_id'  => $request->pegawai_id,
            'hari'        => $request->hari,
            'tanggal'     => $request->tanggal,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'kegiatan'    => $request->kegiatan,
        ]);

        return redirect()->route('admin.jadwal_kerja.index')->with('success', 'Jadwal kerja berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $jadwal = JadwalKerja::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal_kerja.index')->with('success', 'Jadwal kerja berhasil dihapus.');
    }
}
