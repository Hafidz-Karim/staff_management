@extends('admin.layout')

@section('content')
    <div class="space-y-6">

        <!-- Header Section -->
        <div class="flex justify-between items-center mt-4">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Jadwal Kerja Pegawai
            </h2>

            <a href="{{ route('admin.jadwal_kerja.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-xl shadow-md
                       hover:bg-blue-700 transition duration-200">
                Tambah Jadwal
            </a>
        </div>

        <!-- Table Card -->
        <div class="bg-white dark:bg-gray-900 shadow-lg rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">

            <table class="w-full text-gray-700 dark:text-gray-300">
                <thead class="bg-blue-600 dark:bg-blue-700 text-white">
                    <tr class="text-sm uppercase font-semibold">
                        <th class="px-6 py-3 text-left">Pegawai</th>
                        <th class="px-6 py-3 text-left">Hari</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Deskripsi</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($jadwals as $jadwal)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                            <td class="px-6 py-3">{{ $jadwal->pegawai->name }}</td>
                            <td class="px-6 py-3">{{ $jadwal->hari }}</td>
                            <td class="px-6 py-3">{{ $jadwal->tanggal }}</td>
                            <td class="px-6 py-3">{{ $jadwal->kegiatan }}</td>

                            <td class="px-6 py-3 text-center">
                                <form action="{{ route('admin.jadwal_kerja.destroy', $jadwal->id) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        onclick="return confirm('Yakin mau hapus?')"
                                        class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 font-semibold transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5"
                                class="text-center py-6 text-gray-500 dark:text-gray-400">
                                Belum ada jadwal kerja.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>
@endsection
