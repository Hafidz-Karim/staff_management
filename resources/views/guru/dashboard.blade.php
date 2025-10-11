    @extends('guru.layout')

    @section('content')
        <!-- Header yang diperindah, tanpa ubah layout -->
        <div class="bg-gradient-to-r from-blue-50 to-white border border-blue-100 rounded-xl p-6 mb-6 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center shadow-inner">
                    <span class="text-2xl">🎓</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard Guru</h1>
                    <p class="text-gray-600 mt-1">
                        Selamat datang, <span class="font-semibold text-blue-600">{{ Auth::user()->name }}</span> 👋
                    </p>
                </div>
            </div>
        </div>

        <!-- Card fitur -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Card Jadwal -->
            <a href="{{ route('guru.jadwal.index') }}"
            class="p-4 bg-white rounded-xl shadow hover:shadow-lg border border-gray-100
                    transition transform hover:-translate-y-1 flex flex-col items-center text-center">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 mb-3">
                    <span class="text-2xl text-blue-600">📅</span>
                </div>
                <h3 class="text-sm font-semibold text-gray-800">Jadwal Mengajar</h3>
                <p class="text-xs text-gray-500 mt-1">Lihat dan kelola jadwal Anda</p>
            </a>

            <!-- Card Laporan -->
            <a href="{{ route('guru.laporan.index') }}"
            class="p-4 bg-white rounded-xl shadow hover:shadow-lg border border-gray-100
                    transition transform hover:-translate-y-1 flex flex-col items-center text-center">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-green-100 mb-3">
                    <span class="text-2xl text-green-600">📝</span>
                </div>
                <h3 class="text-sm font-semibold text-gray-800">Laporan Harian</h3>
                <p class="text-xs text-gray-500 mt-1">Buat & simpan laporan harian</p>
            </a>

            <!-- Card Absensi -->
            <a href="{{ route('guru.absensi.index') }}"
            class="p-4 bg-white rounded-xl shadow hover:shadow-lg border border-gray-100
                    transition transform hover:-translate-y-1 flex flex-col items-center text-center">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-yellow-100 mb-3">
                    <span class="text-2xl text-yellow-500">✅</span>
                </div>
                <h3 class="text-sm font-semibold text-gray-800">Absensi Santri</h3>
                <p class="text-xs text-gray-500 mt-1">Kelola absensi dengan mudah</p>
            </a>
        </div>
    @endsection
