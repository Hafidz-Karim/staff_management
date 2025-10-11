@extends('admin.layout')

@section('content')
<div class="space-y-6">

    <!-- Header Dashboard -->
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">📊 Dashboard Admin</h1>
    </div>

    <!-- Statistik Ringkasan -->
    {{-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-700">Total Pegawai</h2>
            <p class="text-2xl font-bold text-blue-600">{{ $totalPegawai ?? 0 }}</p>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-700">Total Jadwal Kerja</h2>
            <p class="text-2xl font-bold text-blue-600">{{ $totalJadwal ?? 0 }}</p>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-700">Total guru</h2>
            <p class="text-2xl font-bold text-blue-600">{{ $totalDepartemen ?? 0 }}</p>
        </div>
    </div> --}}

    <!-- Section Jadwal Kerja -->
    <div class="flex justify-between items-center mt-6">
        <h2 class="text-2xl font-bold text-gray-800">📅 Jadwal Kerja Pegawai</h2>
        <a href="{{ route('admin.jadwal_kerja.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
            ➕ Tambah Jadwal
        </a>
    </div>

    <!-- Tabel Jadwal Kerja -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg border border-gray-200">
        <table class="min-w-max w-full table-auto text-gray-800">
            <thead class="bg-blue-600 text-white uppercase text-sm font-semibold">
                <tr>
                    <th class="px-6 py-3 text-left">Pegawai</th>
                    <th class="px-6 py-3 text-left">Hari</th>
                    <th class="px-6 py-3 text-left">Tanggal</th>
                    <th class="px-6 py-3 text-left">Deskripsi</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($jadwals as $jadwal)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="px-6 py-3">{{ $jadwal->pegawai->name }}</td>
                        <td class="px-6 py-3">{{ $jadwal->hari }}</td>
                        <td class="px-6 py-3">{{ $jadwal->tanggal }}</td>
                        <td class="px-6 py-3">{{ $jadwal->kegiatan }}</td>
                        <td class="px-6 py-3 text-center">
                            <form action="{{ route('admin.jadwal_kerja.destroy', $jadwal->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin mau hapus?')"
                                    class="text-red-600 hover:text-red-800 font-semibold transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-6 text-gray-500">Belum ada jadwal kerja.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
