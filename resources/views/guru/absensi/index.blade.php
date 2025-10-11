@extends('guru.layout')
@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Daftar Absensi</h1>
    <a href="{{ route('guru.absensi.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
        ➕ Tambah Absensi
    </a>
</div>

<div class="overflow-x-auto bg-white shadow-lg rounded-lg border border-gray-200">
    <table class="min-w-max w-full table-auto text-gray-800">
        <thead class="bg-blue-600 text-white uppercase text-sm font-semibold">
            <tr>
                <th class="px-6 py-3 text-left">Nama Siswa</th>
                <th class="px-6 py-3 text-left">Tanggal</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($absensis as $absensi)
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-6 py-3 whitespace-nowrap">{{ $absensi->siswa->nama ?? '-' }}</td>
                    <td class="px-6 py-3 whitespace-nowrap">{{ $absensi->tanggal }}</td>
                    <td class="px-6 py-3">
                        <span
                            class="
                            inline-block px-3 py-1 rounded-full text-sm font-semibold
                            @if ($absensi->status === 'hadir') bg-green-100 text-green-800
                            @elseif($absensi->status === 'izin') bg-yellow-100 text-yellow-800
                            @elseif($absensi->status === 'sakit') bg-blue-100 text-blue-800
                            @else bg-red-100 text-red-800 @endif
                        ">
                            {{ ucfirst($absensi->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-3 text-center whitespace-nowrap space-x-4">
                        <a href="{{ route('guru.absensi.edit', $absensi->id) }}"
                            class="text-blue-600 hover:text-blue-800 font-semibold transition">
                            Edit
                        </a>
                        <form action="{{ route('guru.absensi.destroy', $absensi->id) }}" method="POST" class="inline">
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
                <tr>
                    <td colspan="4" class="text-center py-6 text-gray-500">
                        Belum ada data absensi.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
