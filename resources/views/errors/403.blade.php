<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>403 | Akses Ditolak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
        }
        .shake {
            animation: shake 0.5s infinite;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .fade-in {
            animation: fadeIn 1.5s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="text-center fade-in">
    <div class="text-8xl font-bold text-red-500 shake">403</div>

    <h1 class="mt-4 text-2xl font-semibold text-gray-800">
        Akses Ditolak 🚫
    </h1>

    <p class="mt-2 text-gray-600 max-w-md mx-auto">
        Halaman ini bukan untuk role akun Anda.
        Silakan kembali ke dashboard sesuai akses Anda.
    </p>

    <div class="mt-6 space-x-3">
        <a href="{{ url()->previous() }}"
           class="px-5 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
            Kembali
        </a>

        <a href="/redirect"
           class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Ke Dashboard
        </a>
    </div>
</div>

</body>
</html>
