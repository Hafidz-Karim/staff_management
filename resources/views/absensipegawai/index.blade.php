@extends('pegawai.layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow p-6 mt-6">
    <h2 class="text-2xl font-bold mb-4">Absensi Pegawai</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-3">{{ session('success') }}</div>
    @elseif (session('info'))
        <div class="bg-blue-100 text-blue-700 p-3 rounded mb-3">{{ session('info') }}</div>
    @endif

    <form action="{{ route('absensipegawai.store') }}" method="POST">
        @csrf
        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow">
            Absen Sekarang
        </button>
    </form>

    <table class="w-full mt-6 border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Masuk</th>
                <th class="border p-2">Pulang</th>
                <th class="border p-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($absensis as $absen)
                <tr>
                    <td class="border p-2">{{ $absen->tanggal }}</td>
                    <td class="border p-2">{{ $absen->waktu_masuk ?? '-' }}</td>
                    <td class="border p-2">{{ $absen->waktu_pulang ?? '-' }}</td>
                    <td class="border p-2">
                        @if ($absen->status == 'ontime')
                            <span class="text-green-600 font-semibold">Ontime</span>
                        @elseif ($absen->status == 'terlambat')
                            <span class="text-red-600 font-semibold">Terlambat</span>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center p-3 text-gray-500">Belum ada data absensi</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
