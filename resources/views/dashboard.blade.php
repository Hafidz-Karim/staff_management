<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Management Staff') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Kartu Sambutan --}}
            <div
               class="mx-auto max-w-6xl px-6 py-6 bg-blue-500 rounded-2xl text-white">
                <h2 class="text-3xl font-bold">Selamat datang, {{ auth()->user()->name }}</h2>
                <p class="mt-1 text-sm opacity-90">
                    Pilih fitur di bawah sesuai kebutuhanmu
                </p>
            </div>

            {{-- Menu Fitur --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Fitur Admin --}}
                <a href="{{ route('admin.dashboard.index') }}"
                    class="group block bg-white border border-gray-200 rounded-2xl shadow hover:shadow-xl p-6 transition transform hover:-translate-y-1 hover:bg-blue-500 hover:border-blue-600">

                    <div class="flex items-center space-x-4">
                        <div class="p-4 bg-blue-100 rounded-full transition duration-300 group-hover:bg-blue-500">
                            <div class="text-4xl text-blue-600 text-center group-hover:text-white">
                               <i class="ri-user-3-line"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 transition group-hover:text-white">Fitur
                                Admin</h3>
                            <p class="text-sm text-gray-500 transition group-hover:text-blue-100">
                                Kelola data pengguna, jadwal, dan sistem utama.
                            </p>
                        </div>
                    </div>
                </a>
                {{-- Fitur Guru --}}
                <a href="{{ route('guru.dashboard.index') }}"
                    class="group block bg-white border border-blue-200 rounded-2xl shadow hover:shadow-xl p-6 transition transform hover:-translate-y-1 hover:bg-blue-500 hover:border-blue-600">

                    <div class="flex items-center space-x-4">
                        <div class="p-4 bg-blue-100 rounded-full transition duration-300 group-hover:bg-blue-500">
                            <div class="text-4xl text-blue-600 text-center group-hover:text-white">
                                <i class="ri-user-3-line"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 transition group-hover:text-white">Fitur Guru
                            </h3>
                            <p class="text-sm text-gray-500 transition group-hover:text-blue-100">
                                Akses jadwal mengajar, laporan, dan absensi siswa.
                            </p>
                        </div>
                    </div>
                </a>
                {{-- Fitur Pegawai --}}
                <a href="{{ route('pegawai.dashboard') }}"
                    class="group block bg-white border border-blue-200 rounded-2xl shadow hover:shadow-xl p-6 transition transform hover:-translate-y-1 hover:bg-blue-500 hover:border-blue-600">

                    <div class="flex items-center space-x-4">
                        <div class="p-4 bg-blue-100 rounded-full transition duration-300 group-hover:bg-blue-500">
                            <div class="text-4xl text-blue-600 text-center group-hover:text-white">
                                <i class="ri-group-line"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 transition group-hover:text-white">Fitur
                                Pegawai</h3>
                            <p class="text-sm text-gray-500 transition group-hover:text-blue-100">
                                Lihat jadwal kerja, absensi, dan laporan harian.
                            </p>
                        </div>
                    </div>
                </a>

            </div>

            {{-- Tambahan Statistik (Opsional) --}}
            {{-- <div class="bg-white rounded-2xl shadow p-6 mt-8">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Statistik Cepat</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-blue-50 rounded-xl p-4 text-center">
                        <div class="text-3xl font-bold text-blue-700">12</div>
                        <p class="text-sm text-blue-600">Total Guru Aktif</p>
                    </div>
                    <div class="bg-green-50 rounded-xl p-4 text-center">
                        <div class="text-3xl font-bold text-green-700">8</div>
                        <p class="text-sm text-green-600">Pegawai</p>
                    </div>
                    <div class="bg-purple-50 rounded-xl p-4 text-center">
                        <div class="text-3xl font-bold text-purple-700">4</div>
                        <p class="text-sm text-purple-600">Program Aktif</p>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
</x-app-layout>
