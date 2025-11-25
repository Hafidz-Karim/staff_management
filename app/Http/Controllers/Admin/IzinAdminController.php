<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use Illuminate\Http\Request;

class IzinAdminController extends Controller
{
    // TAMPILKAN SEMUA PENGAJUAN IZIN
    public function index()
    {
        // Ambil semua pengajuan beserta data user
        $izins = Izin::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.izin.index', compact('izins')); // nama variabel sesuai Blade
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
