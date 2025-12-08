@extends('admin.layout')

@section('content')
    <div class="max-w-6xl mx-auto mt-10">

        <h1 class="text-2xl font-bold mb-6">Pengajuan Izin Pegawai</h1>

        {{-- FILTER FORM --}}
        <div class="bg-white p-4 rounded-md shadow mb-6 border">
            <form method="GET" action="{{ route('admin.izin.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">

                {{-- Filter Nama Pegawai --}}
                <div>
                    <label class="text-sm font-semibold">Nama Pegawai</label>
                    <input type="text" name="nama" value="{{ request('nama') }}" class="w-full border px-3 py-2 rounded">
                </div>

                {{-- Filter Jenis Izin --}}
                <div>
                    <label class="text-sm font-semibold">Jenis Izin</label>
                    <select name="jenis_izin" class="w-full border px-3 py-2 rounded">
                        <option value="">Semua</option>
                        <option value="Sakit" {{ request('jenis_izin') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="Cuti" {{ request('jenis_izin') == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                        <option value="Lain Lain" {{ request('jenis_izin') == 'Lain Lain' ? 'selected' : '' }}>Lain Lain
                        </option>
                    </select>
                </div>

                {{-- Filter Status --}}
                <div>
                    <label class="text-sm font-semibold">Status</label>
                    <select name="status" class="w-full border px-3 py-2 rounded">
                        <option value="">Semua</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui
                        </option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                {{-- Filter Tanggal Dari --}}
                <div>
                    <label class="text-sm font-semibold">Dari Tanggal</label>
                    <input type="date" name="dari" value="{{ request('dari') }}"
                        class="w-full border px-3 py-2 rounded">
                </div>

                {{-- Filter Tanggal Sampai --}}
                <div>
                    <label class="text-sm font-semibold">Sampai Tanggal</label>
                    <input type="date" name="sampai" value="{{ request('sampai') }}"
                        class="w-full border px-3 py-2 rounded">
                </div>

                <div class="md:col-span-5 flex gap-3 mt-2">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>

                    <a href="{{ route('admin.izin.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Reset</a>
                </div>
            </form>
        </div>

        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- TABLE --}}
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-700 border-b-2 border-gray-300">
                        Nama Pegawai
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-700 border-b-2 border-gray-300">
                        Jenis Izin
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-700 border-b-2 border-gray-300">
                        Tanggal Mulai
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-700 border-b-2 border-gray-300">
                        Tanggal Selesai
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-700 border-b-2 border-gray-300">
                        Alasan
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-700 border-b-2 border-gray-300">
                        Bukti
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-700 border-b-2 border-gray-300">
                        Status
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-700 border-b-2 border-gray-300">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($izin as $item)
                    <tr class="border-b border-gray-200">
                        <td class="px-4 py-3 text-gray-800 text-sm">
                            {{ $item->user->name }}
                        </td>

                        <td class="px-4 py-3 text-gray-800 text-sm">
                            {{ $item->jenis_izin }}
                        </td>

                        <td class="border px-4 py-2">
                            {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}
                        </td>

                        <td class="border px-4 py-2">
                            {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d-m-Y') }}
                        </td>


                        <td class="px-4 py-3 text-gray-800 text-sm">
                            {{ $item->alasan }}
                        </td>

                        <td class="px-4 py-3 text-sm">
                            @if ($item->bukti)
                                <a href="{{ asset('uploads/izin/' . $item->bukti) }}" target="_blank"
                                    class="text-blue-600 underline">Lihat Bukti</a>
                            @else
                                -
                            @endif
                        </td>

                        <td
                            class="px-4 py-3 text-sm font-semibold
                {{ $item->status == 'disetujui'
                    ? 'text-green-600'
                    : ($item->status == 'ditolak'
                        ? 'text-red-600'
                        : 'text-yellow-500') }}">
                            {{ ucfirst($item->status) }}
                        </td>

                        <td class="px-4 py-3 text-sm">
                            @if ($item->status == 'pending')
                                <form action="{{ route('admin.izin.update-status', $item->id) }}" method="POST"
                                    class="flex gap-2">
                                    @csrf
                                    <button name="status" value="disetujui"
                                        class="bg-green-500 text-white px-2 py-1 rounded">Setuju</button>
                                    <button name="status" value="ditolak"
                                        class="bg-red-500 text-white px-2 py-1 rounded">Tolak</button>
                                </form>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $izin->links() }}
        </div>


    </div>
@endsection
