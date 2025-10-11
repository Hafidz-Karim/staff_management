<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Management Staff') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Kartu Sambutan --}}
            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center space-x-4">
                    <div class="text-5xl">👋</div>
                    <div>
                        <h1 class="text-2xl font-bold">Selamat datang, {{ Auth::user()->name }}!</h1>
                        <p class="text-sm opacity-90">Selamat datang kembali. Pilih fitur di bawah sesuai kebutuhanmu 👇</p>
                    </div>
                </div>
            </div>

            {{-- Menu Fitur --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Fitur Admin --}}
                <a href="{{ route('admin.jadwal_kerja.index') }}"
                   class="group bg-white border border-gray-200 rounded-2xl shadow hover:shadow-xl p-6 transition transform hover:-translate-y-1">
                    <div class="flex items-center space-x-4">
                        <div class="bg-gray-100 p-3 rounded-full group-hover:bg-gray-200 transition">
                           <div class="text-4xl mb-3 text-blue-600 text-center">⚙️</div>

                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Fitur Admin</h3>
                            <p class="text-sm text-gray-500">Kelola data pengguna, jadwal, dan sistem utama.</p>
                        </div>
                    </div>
                </a>

                {{-- Fitur Guru --}}
                <a href="{{ route('guru.dashboard.index') }}"
                   class="group bg-green-100 border border-green-200 rounded-2xl shadow hover:shadow-xl p-6 transition transform hover:-translate-y-1">
                    <div class="flex items-center space-x-4">
                        <div class="bg-green-200 p-3 rounded-full group-hover:bg-green-300 transition">
                            <div class="text-4xl mb-3 text-blue-600 text-center">⚙️</div>

                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-green-800">Fitur Guru</h3>
                            <p class="text-sm text-green-600">Akses jadwal mengajar, laporan, dan absensi siswa.</p>
                        </div>
                    </div>
                </a>

                {{-- Fitur Pegawai --}}
                <a href="{{ route('pegawai.jadwal.index') }}"
                   class="group bg-purple-100 border border-purple-200 rounded-2xl shadow hover:shadow-xl p-6 transition transform hover:-translate-y-1">
                    <div class="flex items-center space-x-4">
                        <div class="bg-purple-200 p-3 rounded-full group-hover:bg-purple-300 transition">
                            <div class="text-4xl mb-3 text-blue-600 text-center">⚙️</div>

                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-purple-800">Fitur Pegawai</h3>
                            <p class="text-sm text-purple-600">Lihat jadwal kerja, absensi, dan laporan harian.</p>
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
