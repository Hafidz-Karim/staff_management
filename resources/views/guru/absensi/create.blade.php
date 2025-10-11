@extends('guru.layout')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow border border-gray-200">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">➕ Tambah Absensi</h1>

    <form action="{{ route('guru.absensi.store') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Pilih Siswa -->
        <div>
            <label for="siswa_id" class="block text-gray-700 font-medium mb-2">Nama Siswa</label>
            <select name="siswa_id" id="siswa_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Siswa --</option>
                @foreach($siswas as $siswa)
                    <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                @endforeach
            </select>
            @error('siswa_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tanggal -->
        <div>
            <label for="tanggal" class="block text-gray-700 font-medium mb-2">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('tanggal')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
            <select name="status" id="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Status --</option>
                <option value="hadir">Hadir</option>
                <option value="izin">Izin</option>
                <option value="sakit">Sakit</option>
                <option value="alpa">Alpa</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol -->
        <div class="flex justify-between items-center">
            <a href="{{ route('guru.absensi.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg shadow hover:bg-gray-400 transition">
                ⬅ Kembali
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                Simpan Absensi
            </button>
        </div>
    </form>
</div>
@endsection
