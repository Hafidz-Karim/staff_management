@extends('admin.layout')

@section('content')
<div class="p-6 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-bold mb-4">📋 Daftar Absensi Pegawai & Guru</h2>

    <div class="grid grid-cols-3 gap-4 mb-4">
        <div class="p-4 bg-green-100 rounded-lg text-center">
            <p class="text-lg font-semibold">Total Ontime</p>
            <p class="text-2xl font-bold">{{ $totalHadir }}</p>
        </div>
        <div class="p-4 bg-yellow-100 rounded-lg text-center">
            <p class="text-lg font-semibold">Total Terlambat</p>
            <p class="text-2xl font-bold">{{ $totalTerlambat }}</p>
        </div>
        <div class="p-4 bg-blue-100 rounded-lg text-center">
            <p class="text-lg font-semibold">Total Absensi</p>
            <p class="text-2xl font-bold">{{ $absensi->count() }}</p>
        </div>
    </div>

    <table class="min-w-full bg-white border rounded-lg">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Jam Masuk</th>
                <th class="px-4 py-2">Jam Pulang</th>
                <th class="px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensi as $index => $data)
            <tr class="border-b">
                <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                <td class="px-4 py-2">{{ $data->user->name ?? '-' }}</td>
                <td class="px-4 py-2">{{ $data->tanggal }}</td>
                <td class="px-4 py-2">{{ $data->jam_masuk ?? '-' }}</td>
                <td class="px-4 py-2">{{ $data->jam_pulang ?? '-' }}</td>
                <td class="px-4 py-2">
                    @if($data->status === 'ontime')
                        <span class="text-green-600 font-semibold">Ontime</span>
                    @else
                        <span class="text-red-600 font-semibold">Terlambat</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
