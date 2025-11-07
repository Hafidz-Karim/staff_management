<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center">
        <div class="text-lg font-bold">Sistem Manajemen Staf - Admin</div>
        <div>
            <a href="{{ route('dashboard') }}" class="px-3"> <i class="ri-home-4-line"></i>Home</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="px-3 hover:underline"><i class="ri-logout-box-line"></i> Logout</button>
            </form>
            <a href="{{ route('admin.absensi.index') }}" class="block py-2 px-4 ">
                <i class="ri-sticky-note-line"></i> Data Absensi
            </a>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto p-6">
        @yield('content')
    </div>
</body>

</html>
