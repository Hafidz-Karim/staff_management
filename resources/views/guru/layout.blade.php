<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guru Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-blue-600 text-white p-6">
        <div class="text-2xl font-bold mb-8">Logo</div>
        <nav class="space-y-2">
            <a href="{{ route('guru.dashboard') }}" class="block px-4 py-2 bg-blue-700 rounded">Dashboard</a>
            <a href="{{ route('guru.jadwal') }}" class="block px-4 py-2 hover:bg-blue-500 rounded">Jadwal Mengajar</a>
            <a href="{{ route('guru.laporan') }}" class="block px-4 py-2 hover:bg-blue-500 rounded">Laporan Harian</a>
            <a href="{{ route('guru.absensi') }}" class="block px-4 py-2 hover:bg-blue-500 rounded">Absensi Santri</a>
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button type="submit" class="w-full px-4 py-2 bg-red-500 rounded">Logout</button>
        </form>
    </div>

    <!-- Content -->
    <div class="flex-1 p-8">
        @yield('content')
    </div>
</div>
</body>
</html>
