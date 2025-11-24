@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Card Guru -->
    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Data Guru</h2>
            <i class="ri-user-star-line text-3xl text-blue-600"></i>
        </div>
        <p class="text-gray-600">Total guru terdaftar:</p>
        <p class="text-3xl font-bold text-blue-600 mt-2">1</p>
    </div>

    <!-- Card Pegawai -->
    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Data Pegawai</h2>
            <i class="ri-briefcase-4-line text-3xl text-blue-600"></i>
        </div>
        <p class="text-gray-600">Total Pegawai:</p>
        <p class="text-3xl font-bold text-blue-600 mt-2">4</p>
    </div>

    <!-- Card Admin -->
    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-blue-600">Data Admin</h2>
            <i class="ri-shield-user-line text-3xl text-blue-600"></i>
        </div>
        <p class="text-gray-600">Total Admin:</p>
        <p class="text-3xl font-bold text-blue-600 mt-2">1</p>
    </div>

</div>

<!-- Laporan Bulanan -->
<div class="mt-10 bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-xl font-semibold text-gray-600 mb-4">Laporan Bulan Ini</h2>
    <p class="text-3xl font-bold text-blue-600">3</p>
</div>

@endsection
