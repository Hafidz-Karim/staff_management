@extends('guru.layout')

@section('content')
    <!-- Header -->
    <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-8 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center shadow-inner">
                <span class="text-3xl">🎓</span>
            </div>

            <div>
                <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Dashboard Guru</h1>
                <p class="text-gray-600 mt-1 text-sm">
                    Selamat datang kembali,
                    <span class="font-semibold text-blue-600">{{ Auth::user()->name }}</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Informasi Cepat -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">

        <!-- Total Kelas -->
        <div class="p-4 bg-gradient-to-r from-blue-50 to-white border border-blue-100 rounded-xl shadow-sm flex items-center gap-4">
            <div class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center text-xl"><i class="ri-book-open-line text-xl text-white"></i></div>
            <div>
                <h4 class="text-xs text-gray-500">Total Kelas Diampu</h4>
                <p class="text-lg font-semibold text-gray-800">{{ $kelas_count ?? '-' }}</p>
            </div>
        </div>

        <!-- Laporan Minggu Ini -->
        <div class="p-4 bg-gradient-to-r from-blue-50 to-white border border-blue-100 rounded-xl shadow-sm flex items-center gap-4">
            <div class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center text-xl"><i class="ri-file-list-2-line text-white"></i></div>
            <div>
                <p class="text-xs text-gray-500">Laporan Minggu Ini</p>
                <p class="text-lg font-semibold text-gray-800">{{ $laporan_count ?? '-' }}</p>
            </div>
        </div>

        <!-- Jadwal Hari Ini -->
        <div class="p-4 bg-gradient-to-r from-blue-50 to-white border border-blue-100 rounded-xl shadow-sm flex items-center gap-4">
            <div class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center text-xl">
                <i class="ri-calendar-todo-fill text-white"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500">Jadwal Hari Ini</p>
                <p class="text-lg font-semibold text-gray-800">{{ $jadwal_hari_ini ?? '-' }}</p>
            </div>
        </div>

    </div>
@endsection
