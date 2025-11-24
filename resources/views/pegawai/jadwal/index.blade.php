@extends('pegawai.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Jadwal Kerja Saya</h1>

<table class="min-w-full table-auto bg-white shadow rounded-lg">
    <thead class="bg-blue-600 text-white">
        <tr>
            <th class="px-6 py-3">Hari</th>
            <th class="px-6 py-3">Tanggal</th>
            <th class="px-6 py-3">Jam Mulai</th>
            <th class="px-6 py-3">Jam Selesai</th>
            <th class="px-6 py-3">Kegiatan</th>
        </tr>
    </thead>
    <tbody>
        @forelse($jadwals as $jadwal)
            <tr class="hover:bg-blue-50">
                <td class="px-6 py-3">{{ $jadwal->hari }}</td>
                <td class="px-6 py-3">{{ $jadwal->tanggal }}</td>
                <td class="px-6 py-3">{{ $jadwal->jam_mulai }}</td>
                <td class="px-6 py-3">{{ $jadwal->jam_selesai }}</td>
                <td class="px-6 py-3">{{ $jadwal->kegiatan }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center py-6 text-gray-500">Belum ada jadwal kerja.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
