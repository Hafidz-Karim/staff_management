<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = User::where('role', 'pegawai')->paginate(10);

        return view('admin.pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('admin.pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'pegawai',
            'jenis' => $request->jenis ?? null,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pegawai = User::findOrFail($id);
        return view('admin.pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $pegawai = User::findOrFail($id);

        $pegawai->update([
            'name' => $request->name,
            'email' => $request->email,
            'jenis' => $request->jenis,
        ]);

        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai diperbarui.');
    }

    public function nonaktifkan($id)
    {
        $pegawai = User::findOrFail($id);
        $pegawai->update(['is_active' => false]);

        return redirect()->back()->with('success', 'Pegawai berhasil dinonaktifkan.');
    }

    public function aktifkan($id)
    {
        $pegawai = User::findOrFail($id);
        $pegawai->update(['is_active' => true]);

        return redirect()->back()->with('success', 'Pegawai berhasil diaktifkan kembali.');
    }
}
