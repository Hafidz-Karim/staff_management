@extends('guru.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Absensi</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('guru.absensi.update', $absensi->id) }}" method="POST"
        class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-medium">Nama Siswa</label>
            <select name="siswa_id" required class="w-full border rounded px-3 py-2">
                <option value="">-- pilih siswa --</option>
                @foreach ($siswas as $siswa)
                    <option value="{{ $siswa->id }}"
                        {{ old('siswa_id', $absensi->siswa_id) == $siswa->id ? 'selected' : '' }}>
                        {{ $siswa->nama }} {{ $siswa->nis ? "({$siswa->nis})" : '' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $absensi->tanggal) }}" required
                class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block mb-1 font-medium">Status</label>
            <select name="status" required class="w-full border rounded px-3 py-2">
                <option value="">-- pilih status --</option>
                <option value="hadir" {{ old('status', $absensi->status) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                <option value="izin" {{ old('status', $absensi->status) == 'izin' ? 'selected' : '' }}>Izin</option>
                <option value="sakit" {{ old('status', $absensi->status) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                <option value="alpa" {{ old('status', $absensi->status) == 'alpa' ? 'selected' : '' }}>Alpa</option>
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium">Keterangan (opsional)</label>
            <textarea name="keterangan" class="w-full border rounded px-3 py-2" rows="3">{{ old('keterangan', $absensi->keterangan) }}</textarea>
        </div>

        <div class="flex items-center space-x-3">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Update</button>
            <a href="{{ route('guru.absensi.index') }}" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
        </div>
    </form>
@endsection
