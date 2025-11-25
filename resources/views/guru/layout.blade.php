<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru Dashboard</title>
    <style>
        .smooth-shadow {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: "class",
        };
    </script>

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <script>
        if (localStorage.getItem("theme") === "dark") {
            document.documentElement.classList.add("dark");
        }

        function toggleTheme() {
            const html = document.documentElement;
            html.classList.toggle("dark");
            localStorage.setItem("theme", html.classList.contains("dark") ? "dark" : "light");
        }
    </script>
</head>

<body class="bg-gray-100 dark:bg-[#0d1525] text-gray-800 dark:text-gray-200 transition">

    <div class="flex">

        <!-- SIDEBAR -->
        <aside
            class="fixed top-0 left-0 w-64 h-full bg-white dark:bg-[#0f172a]
                   border-r border-gray-200 dark:border-gray-700 p-6 flex flex-col shadow-sm">

            <!-- LOGO -->
            <div class="flex items-center gap-3 mb-10 mt-2">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center">
                    <i class="ri-book-open-line text-xl text-white"></i>
                </div>
                <span class="text-xl font-bold text-gray-800 dark:text-gray-200">
                    Management staff
                </span>
            </div>

            <!-- MENU -->
            <nav class="flex-1 space-y-3">

                <a href="{{ route('guru.dashboard.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                     {{ request()->routeIs('guru.dashboard.index') ? 'bg-blue-100 dark:bg-blue-800' : '' }}
                       text-gray-700 dark:text-white hover:bg-blue-100 dark:hover:bg-blue-800 transition">
                    <i class="ri-home-4-line text-xl"></i>
                    Dashboard
                </a>
                <a href="{{ route('absensipegawai.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
           {{ request()->routeIs('absensipegawai.*') ? 'bg-blue-100 dark:bg-blue-800' : '' }}
           text-gray-700 dark:text-gray-300 hover:bg-blue-100 dark:hover:bg-blue-700 transition">
                    <i class="ri-calendar-check-line text-xl"></i>
                    Absensi Harian
                </a>
                <a href="{{ route('guru.jadwal.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                     {{ request()->routeIs('guru.jadwal.*') ? 'bg-blue-100 dark:bg-blue-800' : '' }}
                       text-gray-700 dark:text-white hover:bg-blue-100 dark:hover:bg-blue-800 transition">
                    <i class="ri-calendar-check-line text-xl"></i>
                    Jadwal Mengajar
                </a>

                <a href="{{ route('guru.laporan.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                     {{ request()->routeIs('guru.laporan.*') ? 'bg-blue-100 dark:bg-blue-800' : '' }}
                       text-gray-700 dark:text-white hover:bg-blue-100 dark:hover:bg-blue-800 transition">
                    <i class="ri-file-list-2-line text-xl"></i>
                    Laporan Harian
                </a>

                <a href="{{ route('izin.create') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                     {{ request()->routeIs('guru.absensi.*') ? 'bg-blue-100 dark:bg-blue-800' : '' }}
                       text-gray-700 dark:text-white hover:bg-blue-100 dark:hover:bg-blue-800 transition">
                    <i class="ri-table-line"></i>
                    Ajukan Izin
                </a>
                <a href="{{ route('izin.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                     {{ request()->routeIs('guru.absensi.*') ? 'bg-blue-100 dark:bg-blue-800' : '' }}
                       text-gray-700 dark:text-white hover:bg-blue-100 dark:hover:bg-blue-800 transition">
                    <i class="ri-list-ordered-2"></i>
                    lihat list Izin
                </a>
                <!-- Tombol kembali ke dashboard utama -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                     {{ request()->routeIs('guru.absensi.*') ? 'bg-blue-100 dark:bg-blue-800' : '' }}
                       text-gray-700 dark:text-white hover:bg-blue-100 dark:hover:bg-blue-800 transition">
                    <i class="ri-arrow-go-back-fill"></i> Ke halaman utama
                </a>

            </nav>

            <!-- LOGOUT -->
            <form method="POST" action="{{ route('logout') }}" class="pt-10">
                @csrf
                <button
                    class="w-full bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700
                           text-white px-4 py-3 rounded-xl flex items-center justify-center gap-2 text-lg transition">
                    <i class="ri-logout-circle-r-line text-xl"></i>
                    Logout
                </button>
            </form>

        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="ml-64 min-h-screen flex flex-col w-full">

            <!-- NAVBAR -->
            <nav
                class="bg-white dark:bg-[#0f172a] shadow-sm border-b border-gray-200 dark:border-gray-700
                        px-6 py-4 flex justify-end items-center">

                <div class="flex items-center gap-4">
                    <span class="font-medium text-gray-700 dark:text-gray-300">
                        Halo, {{ auth()->user()->name }}
                    </span>

                    <button onclick="toggleTheme()"
                        class="p-2 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                        <i class="ri-moon-line text-xl"></i>
                    </button>
                </div>

            </nav>

            <!-- MAIN CONTENT -->
            <main class="flex-1 p-8">
                @yield('content')
            </main>

        </div>

    </div>
    <x-footer />
</body>

</html>
