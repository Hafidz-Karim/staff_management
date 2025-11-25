@extends('pegawai.layout')

@section('content')
<div class="max-w-2xl mx-auto p-6">

    {{-- CARD --}}
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">
            Pengajuan Izin
        </h2>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg dark:bg-green-800 dark:text-green-200 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- FORM --}}
        <form action="{{ route('izin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- JENIS IZIN --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">Jenis Izin</label>
                <select name="jenis_izin"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Jenis Izin --</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Izin Pribadi">Izin Pribadi</option>
                    <option value="Acara Keluarga">Acara Keluarga</option>
                </select>
                @error('jenis_izin')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- TANGGAL MULAI --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai"
                       class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('tanggal_mulai')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- TANGGAL SELESAI --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai"
                       class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('tanggal_selesai')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ALASAN --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">Alasan</label>
                <textarea name="alasan" rows="4"
                          class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                @error('alasan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- BUKTI --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">Upload Bukti (Optional)</label>
                <input type="file" name="bukti"
                       class="w-full text-gray-700 dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600 px-3 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('bukti')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- SUBMIT --}}
            <div class="pt-4">
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-3 rounded-xl shadow-lg transition transform hover:-translate-y-1">
                    Ajukan Izin
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
