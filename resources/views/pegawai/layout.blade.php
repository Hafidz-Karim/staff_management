<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegawai Dashboard</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white shadow p-4 flex justify-between items-center">
        <div class="text-lg font-bold">
            📋 Pegawai Dashboard
        </div>
        <div>
            <span class="mr-4">Halo, {{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Sidebar + Content -->
    <div class="flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg min-h-screen p-4">
            <ul>
                <li class="mb-4">
                    <a href="{{ route('pegawai.dashboard') }}" class="block p-2 rounded hover:bg-blue-100">🏠 Dashboard</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('pegawai.jadwal.index') }}" class="block p-2 rounded hover:bg-blue-100">📅 Jadwal Kerja</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('pegawai.profile') }}" class="block p-2 rounded hover:bg-blue-100">👤 Profil</a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-white text-center p-4 mt-6 shadow-inner">
        &copy; {{ date('Y') }} - Sistem Manajemen Staf
    </footer>

</body>
</html>
