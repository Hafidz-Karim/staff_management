@extends('guru.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Dashboard Guru</h1>
    <p class="mb-6">Selamat datang Bpk/Ibu {{ Auth::user()->name }}</p>

    <div class="grid grid-cols-3 gap-6">
        <a href="{{ route('guru.jadwal') }}" class="p-6 bg-white rounded shadow text-center">
            <div class="text-xl font-semibold">Lihat Jadwal Mengajar</div>
        </a>
        <a href="{{ route('guru.laporan') }}" class="p-6 bg-white rounded shadow text-center">
            <div class="text-xl font-semibold">Buat Laporan Harian</div>
        </a>
        <a href="{{ route('guru.absensi') }}" class="p-6 bg-white rounded shadow text-center">
            <div class="text-xl font-semibold">Buat Absensi Santri</div>
        </a>
    </div>
@endsection
