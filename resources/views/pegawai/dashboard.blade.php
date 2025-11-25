@extends('pegawai.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4"> Dashboard Pegawai</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white shadow p-4 rounded-lg">
        <h2 class="text-lg font-semibold">Total Jadwal Kerja</h2>
        <p class="text-2xl font-bold text-blue-600">{{ $totalJadwal }}</p>
    </div>
</div>
@endsection
