@extends('admin.layout')

@section('content')
    <div class="max-w-5xl mx-auto mt-10 bg-white p-6 shadow rounded">

        <h2 class="text-xl font-bold mb-4">Data Pegawai</h2>

        <a href="{{ route('admin.pegawai.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
            + Tambah Pegawai
        </a>

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($pegawai as $p)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $p->name }}</td>
                        <td class="px-4 py-2">{{ $p->email }}</td>
                        <td class="px-4 py-2">
                            @if ($p->is_active)
                                <span class="text-green-600 font-semibold">Aktif</span>
                            @else
                                <span class="text-red-600 font-semibold">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 flex gap-2">

                            <a href="{{ route('admin.pegawai.edit', $p->id) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>

                            @if ($p->is_active)
                                <form action="{{ route('admin.pegawai.nonaktifkan', $p->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button class="bg-red-600 text-white px-3 py-1 rounded">
                                        Nonaktifkan
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.pegawai.aktifkan', $p->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button class="bg-green-600 text-white px-3 py-1 rounded">
                                        Aktifkan
                                    </button>
                                </form>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $pegawai->links() }}
        </div>

    </div>
@endsection
