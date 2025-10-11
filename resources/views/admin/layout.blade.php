<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <!-- Navbar -->
    <nav class="bg-red-600 text-white px-6 py-4 flex justify-between items-center">
        <div class="text-lg font-bold">Sistem Manajemen Staf - Admin</div>
        <div>
            <a href="{{ route('dashboard') }}" class="px-3">🏠 Home</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="px-3 hover:underline">🚪 Logout</button>
            </form>
            <a href="{{ route('admin.absensi.index') }}" class="block py-2 px-4 ">
                📋 Data Absensi
            </a>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto p-6">
        @yield('content')
    </div>
</body>

</html>
