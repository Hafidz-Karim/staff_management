<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Staff</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        /* Smooth shadow & subtle transitions */
        .smooth-shadow {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col font-sans">

    <!-- Navbar -->
    <nav class="bg-white smooth-shadow p-4 sticky top-0 z-20">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center space-x-3 font-bold text-xl">

                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center">
                    <i class="ri-book-open-line text-xl text-white"></i>
                </div>

                <span class="text-gray-900">Management Staff</span>
            </a>

            <div class="space-x-4">
                @auth
                    <!-- FORM LOGOUT -->
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="button" id="logoutBtn"
                            class="text-gray-700 hover:text-gray-900 transition duration-200">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="text-gray-700 hover:text-gray-900 transition duration-200">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="flex-grow py-10">
        <div class="max-w-6xl mx-auto px-4">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white smooth-shadow p-4 text-center text-gray-500 text-sm mt-10">
        &copy; {{ date('Y') }} Management Staff. All rights reserved.
    </footer>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert Konfirmasi Logout -->
    <script>
        const logoutBtn = document.getElementById("logoutBtn");
        const logoutForm = document.getElementById("logoutForm");

        if (logoutBtn) {
            logoutBtn.addEventListener("click", function() {
                Swal.fire({
                    title: "Yakin ingin logout?",
                    text: "Anda akan keluar dari akun ini.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, logout",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        logoutForm.submit();
                    }
                });
            });
        }
    </script>

    <!-- SweetAlert Success/Error Message -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1800
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Gagal",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

</body>

</html>
