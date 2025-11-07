@extends('admin.layout')

@section('content')
    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-xl p-6 mt-6">
        <h2 class="text-2xl font-bold mb-4"><i class="ri-sticky-note-2-line"></i> Rekap Absensi Pegawai & Guru</h2>

        {{-- Form Filter --}}
        <form method="GET" action="{{ route('admin.absensi.index') }}" class="flex flex-wrap gap-3 mb-6">
            <input type="text" name="nama" placeholder="Cari nama pegawai/guru..." value="{{ $filters['nama'] ?? '' }}"
                class="border rounded-lg px-4 py-2 flex-1 min-w-[200px]">

            <input type="date" name="tanggal" value="{{ $filters['tanggal'] ?? '' }}"
                class="border rounded-lg px-4 py-2">

            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                <i class="ri-search-line"></i> Filter
            </button>

            <a href="{{ route('admin.absensi.index') }}"
                class="bg-red-500 text-gray-800 px-5 py-2 rounded-lg text-white hover:bg-gray-400">
                <i class="ri-reset-left-line"></i> Reset
            </a>
            <a href="{{ route('admin.absensi.preview', request()->query()) }}" class="bg-green-500 text-gray-800 px-5 py-2 rounded-lg text-white hover:bg-gray-400">
                Lihat Laporan
            </a>

        </form>

        {{-- Tabel Absensi --}}
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Hari</th>
                    <th class="border p-2">Masuk</th>
                    <th class="border p-2">Pulang</th>
                    <th class="border p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($absensi as $absen)
                    <tr>
                        <td class="border p-2">{{ $absen->user->name ?? '-' }}</td>
                        <td class="border p-2">{{ $absen->tanggal }}</td>
                        <td class="border p-2">{{ $absen->hari }}</td>
                        <td class="border p-2">{{ $absen->waktu_masuk ?? '-' }}</td>
                        <td class="border p-2">{{ $absen->waktu_pulang ?? '-' }}</td>
                        <td class="border p-2">
                            @if ($absen->status === 'ontime')
                                <span class="text-green-600 font-semibold">Ontime</span>
                            @elseif ($absen->status === 'terlambat')
                                <span class="text-red-600 font-semibold">Terlambat</span>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 p-4">
                            Tidak ada data absensi ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
