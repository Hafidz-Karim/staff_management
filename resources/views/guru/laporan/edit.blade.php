@extends('guru.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Laporan Harian</h1>

    <form action="{{ route('guru.laporan.update', $laporan->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1">Tanggal</label>
            <input type="date" name="tanggal" class="w-full border rounded px-3 py-2" value="{{ $laporan->tanggal }}" required>
        </div>

        <div>
            <label class="block mb-1">Kelas</label>
            <input type="text" name="kelas" class="w-full border rounded px-3 py-2" value="{{ $laporan->kelas }}" required>
        </div>

        <div>
            <label class="block mb-1">Hari</label>
            <input type="text" name="hari" class="w-full border rounded px-3 py-2" value="{{ $laporan->hari }}" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-1">Jam Mulai</label>
                <input type="time" name="jam_mulai" class="w-full border rounded px-3 py-2" value="{{ $laporan->jam_mulai }}" required>
            </div>
            <div>
                <label class="block mb-1">Jam Selesai</label>
                <input type="time" name="jam_selesai" class="w-full border rounded px-3 py-2" value="{{ $laporan->jam_selesai }}" required>
            </div>
        </div>

        <div>
            <label class="block mb-1">Materi</label>
            <input type="text" name="materi" class="w-full border rounded px-3 py-2" value="{{ $laporan->materi }}" required>
        </div>

        <div>
            <label class="block mb-1">Catatan</label>
            <textarea name="catatan" class="w-full border rounded px-3 py-2">{{ $laporan->catatan }}</textarea>
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Update
        </button>
        <a href="{{ route('guru.laporan.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
            Batal
        </a>
    </form>
@endsection
