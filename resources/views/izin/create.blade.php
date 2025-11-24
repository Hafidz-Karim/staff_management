@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">

    {{-- CARD --}}
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 border dark:border-gray-700">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">
            Pengajuan Izin
        </h2>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded dark:bg-green-800 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif

        {{-- FORM --}}
        <form action="{{ route('izin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            {{-- JENIS IZIN --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Jenis Izin</label>
                <select name="jenis_izin" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    <option value="">-- Pilih Jenis Izin --</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Izin Pribadi">Izin Pribadi</option>
                    <option value="Acara Keluarga">Acara Keluarga</option>
                </select>
                @error('jenis_izin')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- TANGGAL MULAI --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                @error('tanggal_mulai')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- TANGGAL SELESAI --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                @error('tanggal_selesai')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- ALASAN --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Alasan</label>
                <textarea name="alasan" rows="3"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"></textarea>
                @error('alasan')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- BUKTI --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Upload Bukti (Optional)</label>
                <input type="file" name="bukti"
                    class="w-full text-gray-700 dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600">
                @error('bukti')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- SUBMIT --}}
            <div class="pt-3">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md">
                    Ajukan Izin
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
