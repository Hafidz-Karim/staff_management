@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-2">👨‍🏫 Data Guru</h2>
            <p>Total guru yang terdaftar: <span class="font-bold text-blue-600">25</span></p>
            <a href="#" class="mt-3 inline-block text-sm text-blue-600 hover:underline">Lihat Detail</a>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-2">👩‍💼 Data Pegawai</h2>
            <p>Total pegawai: <span class="font-bold text-green-600">12</span></p>
            <a href="#" class="mt-3 inline-block text-sm text-green-600 hover:underline">Lihat Detail</a>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-2">📊 Laporan</h2>
            <p>Jumlah laporan bulan ini: <span class="font-bold text-red-600">7</span></p>
            <a href="#" class="mt-3 inline-block text-sm text-red-600 hover:underline">Lihat Detail</a>
        </div>
    </div>

    <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Aktivitas Terbaru</h2>
        <ul class="list-disc pl-5 space-y-2 text-gray-700">
            <li>Guru A menambahkan jadwal baru.</li>
            <li>Pegawai B memperbarui data kehadiran.</li>
            <li>Laporan keuangan bulan September diunggah.</li>
        </ul>
    </div>
@endsection
