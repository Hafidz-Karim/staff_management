<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use Illuminate\Http\Request;

class IzinAdminController extends Controller
{
    // TAMPILKAN SEMUA PENGAJUAN IZIN
   public function index(Request $request)
{
    $query = Izin::with('user');

    // Filter Nama Pegawai
    if ($request->filled('nama')) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('name', 'LIKE', '%' . $request->nama . '%');
        });
    }

    // Filter Jenis Izin
    if ($request->filled('jenis_izin')) {
        $query->where('jenis_izin', $request->jenis_izin);
    }

    // Filter Status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter tanggal izin (tanggal_mulai)
    if ($request->filled('dari') && $request->filled('sampai')) {
        $query->whereBetween('tanggal_mulai', [
            $request->dari,
            $request->sampai
        ]);
    }

    $izin = $query->latest()->paginate(10);

    return view('admin.izin.index', compact('izin'));
}


    // VERIFIKASI IZIN
    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:disetujui,ditolak',
        'catatan_admin' => 'nullable|string',
    ]);

    $izin = Izin::findOrFail($id);

    try {
        $izin->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->back()->with('success', 'Status izin berhasil diperbarui.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui status.');
    }
}

}
