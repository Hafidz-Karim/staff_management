@extends('guru.layout')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Header -->
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Laporan Harian</h1>

        <!-- Success message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 border border-green-300 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Button tambah laporan -->
        <div class="mb-6">
            <a href="{{ route('guru.laporan.create') }}"
               class="inline-block px-5 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-blue-700 transition">
                + Tambah Laporan
            </a>
        </div>

        <!-- Table container -->
        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm bg-white">
            <table class="min-w-max w-full table-auto text-gray-800">
                <thead class="bg-gray-100 text-sm uppercase font-semibold text-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Kelas</th>
                        <th class="px-6 py-3 text-left">Hari</th>
                        <th class="px-6 py-3 text-left">Jam</th>
                        <th class="px-6 py-3 text-left">Materi</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($laporan as $item)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-3 whitespace-nowrap">{{ $item->tanggal }}</td>
                            <td class="px-6 py-3 whitespace-nowrap">{{ $item->kelas }}</td>
                            <td class="px-6 py-3 whitespace-nowrap">{{ ucfirst($item->hari) }}</td>
                            <td class="px-6 py-3 whitespace-nowrap">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                            <td class="px-6 py-3">{{ $item->materi }}</td>
                            <td class="px-6 py-3 whitespace-nowrap">
                                <div class="flex gap-2">
                                    <a href="{{ route('guru.laporan.edit', $item->id) }}"
                                       class="px-3 py-1 text-sm bg-yellow-400 rounded hover:bg-yellow-500 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('guru.laporan.destroy', $item->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin mau hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1 text-sm bg-red-500 rounded hover:bg-red-600 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                                Belum ada laporan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
