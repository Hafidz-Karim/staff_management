@extends('pegawai.layout')

@section('content')
    <div class="max-w-5xl mx-auto mt-10">

        <h1 class="text-2xl font-bold mb-6">Riwayat Pengajuan Izin</h1>

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($izins->isEmpty())
            <p class="text-gray-600">Belum ada pengajuan izin.</p>
        @else
            <table class="w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2">Jenis Izin</th>
                        <th class="border px-4 py-2">Tanggal Mulai</th>
                        <th class="border px-4 py-2">Tanggal Selesai</th>
                        <th class="border px-4 py-2">Alasan</th>
                        <th class="border px-4 py-2">Bukti</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Aksi</th> <!-- ✔ tambahkan ini -->
                    </tr>
                </thead>

                <tbody>
                    @foreach ($izins as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item->jenis_izin }}</td>
                            <td class="border px-4 py-2">
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}
                            </td>

                            <td class="border px-4 py-2">
                                {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d-m-Y') }}
                            </td>

                            <td class="border px-4 py-2">{{ $item->alasan }}</td>
                            <td class="border px-4 py-2">
                                @if ($item->bukti)
                                    <a href="{{ route('izin.showSuratBukti', $item->id) }}" target="_blank"
                                        class="text-blue-600 underline">Lihat Bukti</a>
                                @else
                                    -
                                @endif
                            </td>

                            <td class="border px-4 py-2 capitalize">{{ $item->status }}</td>

                            <td class="border px-4 py-2">
                                {{-- TOMBOL EDIT HANYA TAMPIL SAAT STATUS PENDING / MENUNGGU --}}
                                @if (strtolower($item->status) == 'pending')
                                    <a href="{{ route('izin.edit', $item->id) }}"
                                        class="bg-orange-400 text-white px-3 py-1 rounded">
                                        Edit
                                    </a>
                                    <form action="{{ route('izin.destroy', $item->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus pengajuan izin ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">
                                            Hapus
                                        </button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        @endif
    </div>
@endsection
