@extends('guru.layout')

@section('content')
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Jadwal Mengajar</h2>
    </div>

    @if($jadwals->isEmpty())
        <div class="bg-yellow-100 text-yellow-800 px-6 py-4 rounded-lg text-lg border border-yellow-300">
            Tidak ada jadwal yang tersedia untuk Anda saat ini.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full text-lg text-left text-gray-800 border border-gray-300 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700 font-semibold uppercase">
                    <tr>
                        <th class="px-6 py-4 border-b">Hari</th>
                        <th class="px-6 py-4 border-b">Mata Pelajaran</th>
                        <th class="px-6 py-4 border-b">Kelas</th>
                        <th class="px-6 py-4 border-b">Jam</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($jadwals as $jadwal)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4">{{ $jadwal->hari }}</td>
                            <td class="px-6 py-4">{{ $jadwal->mata_pelajaran }}</td>
                            <td class="px-6 py-4">{{ $jadwal->kelas }}</td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
