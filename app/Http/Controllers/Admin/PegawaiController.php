<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'pegawai');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qq) use ($q) {
                $qq->where('name', 'like', "%{$q}%")
                   ->orWhere('email', 'like', "%{$q}%");
            });
        }

        $pegawai = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('admin.pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('admin.pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'jabatan'  => 'nullable|string|max:150',
            'no_hp'    => 'nullable|string|max:30',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $password = $request->password ?: 'password123';

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'jabatan'  => $request->jabatan,
            'no_hp'    => $request->no_hp,
            'role'     => 'pegawai',
            'is_active'=> true,
            'password' => Hash::make($password),
        ]);

        return redirect()->route('admin.pegawai.index')
            ->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pegawai = User::where('role', 'pegawai')->findOrFail($id);

        return view('admin.pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $pegawai = User::where('role', 'pegawai')->findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email', Rule::unique('users', 'email')->ignore($pegawai->id)],
            'jabatan'  => 'nullable|string|max:150',
            'no_hp'    => 'nullable|string|max:30',
            'password' => 'nullable|string|min:6',
        ]);

        $pegawai->name    = $request->name;
        $pegawai->email   = $request->email;
        $pegawai->jabatan = $request->jabatan;
        $pegawai->no_hp   = $request->no_hp;

        if ($request->filled('password')) {
            $pegawai->password = Hash::make($request->password);
        }

        $pegawai->save();

        return redirect()->route('admin.pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }

    // Nonaktifkan pegawai (BUKAN hapus)
    public function destroy($id)
    {
        $pegawai = User::where('role', 'pegawai')->findOrFail($id);

        $pegawai->update([
            'is_active' => false
        ]);

        return redirect()->route('admin.pegawai.index')
            ->with('success', 'Pegawai berhasil dinonaktifkan.');
    }

    // Aktifkan kembali
    public function aktifkan($id)
    {
        $pegawai = User::where('role', 'pegawai')->findOrFail($id);

        $pegawai->update([
            'is_active' => true
        ]);

        return redirect()->route('admin.pegawai.index')
            ->with('success', 'Pegawai berhasil diaktifkan kembali.');
    }

    // Nonaktifkan manual (jika pakai tombol khusus)
    public function nonaktifkan($id)
    {
        $pegawai = User::where('role', 'pegawai')->findOrFail($id);

        $pegawai->update([
            'is_active' => false
        ]);

        return redirect()->route('admin.pegawai.index')
            ->with('success', 'Pegawai berhasil dinonaktifkan.');
    }
}
