@extends('admin.layout')

@section('content')
<div class="max-w-6xl mx-auto mt-10">

    <h1 class="text-2xl font-bold mb-6">Pengajuan Izin Pegawai</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">Nama Pegawai</th>
                <th class="border px-4 py-2">Jenis Izin</th>
                <th class="border px-4 py-2">Tanggal Mulai</th>
                <th class="border px-4 py-2">Tanggal Selesai</th>
                <th class="border px-4 py-2">Alasan</th>
                <th class="border px-4 py-2">Bukti</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($izins as $item)
            <tr>
                <td class="border px-4 py-2">{{ $item->user->name }}</td>
                <td class="border px-4 py-2">{{ $item->jenis_izin }}</td>
                <td class="border px-4 py-2">{{ $item->tanggal_mulai }}</td>
                <td class="border px-4 py-2">{{ $item->tanggal_selesai }}</td>
                <td class="border px-4 py-2">{{ $item->alasan }}</td>
                <td class="border px-4 py-2">
                    @if($item->bukti)
                        <a href="{{ asset('storage/'.$item->bukti) }}" target="_blank" class="text-blue-600 underline">Lihat Bukti</a>
                    @else
                        -
                    @endif
                </td>
                <td class="border px-4 py-2 capitalize">
                    @if($item->status == 'pending') Pending
                    @elseif($item->status == 'disetujui') Disetujui
                    @elseif($item->status == 'ditolak') Ditolak
                    @endif
                </td>
                <td class="border px-4 py-2">
                    @if($item->status == 'pending')
                    <form action="{{ route('admin.izin.update-status', $item->id) }}" method="POST" class="flex gap-2">
                        @csrf
                        <button name="status" value="disetujui" class="bg-green-500 text-white px-2 py-1 rounded">Setuju</button>
                        <button name="status" value="ditolak" class="bg-red-500 text-white px-2 py-1 rounded">Tolak</button>
                    </form>
                    @else
                        <span class="text-gray-500">-</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
