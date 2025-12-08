@extends('pegawai.layout')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow p-6 mt-6 rounded">
    <h2 class="text-xl font-bold mb-4">Edit Pengajuan Izin</h2>

    <form action="{{ route('izin.update', $izin->id) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label class="block">Jenis Izin</label>
        <select name="jenis_izin" class="w-full border p-2 rounded mb-3">
            <option value="sakit" {{ $izin->jenis_izin == 'sakit' ? 'selected' : '' }}>Sakit</option>
            <option value="cuti" {{ $izin->jenis_izin == 'cuti' ? 'selected' : '' }}>Cuti</option>
        </select>

        <label class="block">Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" value="{{ $izin->tanggal_mulai }}"
               class="w-full border p-2 rounded mb-3">

        <label class="block">Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" value="{{ $izin->tanggal_selesai }}"
               class="w-full border p-2 rounded mb-3">

        <label class="block">Alasan</label>
        <textarea name="alasan" class="w-full border p-2 rounded mb-3">{{ $izin->alasan }}</textarea>

        <label class="block">Ganti Bukti (opsional)</label>
        <input type="file" name="bukti" class="w-full border p-2 rounded mb-3">

        {{-- Tampilkan bukti lama --}}
        <p class="text-sm mt-1 mb-3">Bukti sebelumnya:</p>
        <img src="{{ asset('storage/' . $izin->bukti) }}" class="h-24 border">

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
