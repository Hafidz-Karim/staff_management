@extends('admin.layout')

@section('content')
    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-xl p-6 mt-6">
        <h2 class="text-2xl font-bold mb-4">
            <i class="ri-sticky-note-2-line"></i> Rekap Absensi Pegawai & Guru
        </h2>

        {{-- Filter & Search --}}
        <form method="GET" action="{{ route('admin.absensi.index') }}" class="flex flex-wrap gap-4 mb-6 items-end">

            {{-- Filter Nama --}}
            <div class="flex flex-col">
                <label class="text-sm font-semibold mb-1 text-gray-700">Cari Nama</label>
                <input type="text" name="nama" value="{{ request('nama') }}" placeholder="Masukkan nama..."
                    class="border rounded-lg px-4 py-2 min-w-[200px]" />
            </div>

            {{-- Filter Bulan --}}
            <div class="flex flex-col">
                <label class="text-sm font-semibold mb-1 text-gray-700">Pilih Bulan</label>
                <select id="bulan" name="bulan" class="border rounded-lg px-4 py-2 min-w-[180px]">
                    <option value="">Pilih Bulan</option>
                    @foreach ([
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ] as $num => $nama)
                        <option value="{{ $num }}" {{ request('bulan') == $num ? 'selected' : '' }}>
                            {{ $nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filter Tanggal --}}
            <div>
                <label class="font-semibold">Pilih Tanggal</label>
                <select name="tanggal" class="border rounded-lg p-2 w-full">
                    <option value="">Pilih tanggal</option>
                    @for ($i = 1; $i <= 31; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>


            {{-- Tombol --}}
            <div class="flex items-center gap-2">
                <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 flex items-center gap-2">
                    <i class="ri-search-line"></i> Filter
                </button>

                <a href="{{ route('admin.absensi.index') }}"
                    class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                    Reset
                </a>

                <a href="{{ route('admin.absensi.preview', request()->query()) }}"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                    Lihat Detail
                </a>
            </div>

        </form>



        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="border p-2">Nama</th>
                        <th class="border p-2">Tanggal</th>
                        <th class="border p-2">Hari</th>
                        <th class="border p-2">Masuk</th>
                        <th class="border p-2">Pulang</th>
                        <th class="border p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($absensi as $absen)
                        <tr>
                            <td class="border p-2">{{ $absen->user->name ?? '-' }}</td>
                            <td class="border p-2">{{ \Carbon\Carbon::parse($absen->tanggal)->translatedFormat('d F Y') }}
                            </td>
                            <td class="border p-2">{{ $absen->hari }}</td>
                            <td class="border p-2">{{ $absen->waktu_masuk ?? '-' }}</td>
                            <td class="border p-2">{{ $absen->waktu_pulang ?? '-' }}</td>
                            <td class="border p-2">
                                @if ($absen->status === 'ontime')
                                    <span class="text-green-600 font-semibold">Ontime</span>
                                @elseif ($absen->status === 'terlambat')
                                    <span class="text-red-600 font-semibold">Terlambat</span>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 p-4">Tidak ada data absensi ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $absensi->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const bulanSelect = document.getElementById("bulan");
            const tanggalSelect = document.getElementById("tanggal");

            if (!bulanSelect || !tanggalSelect) {
                console.error("Element #bulan atau #tanggal tidak ditemukan!");
                return;
            }

            function updateTanggal() {
                const bulan = bulanSelect.value;

                // Reset tanggal
                tanggalSelect.innerHTML = '<option value="">Pilih tanggal</option>';

                if (!bulan) {
                    console.warn("Bulan belum dipilih.");
                    return;
                }

                // Tahun default = tahun sekarang
                const tahun = new Date().getFullYear();

                // Hitung jumlah hari dalam bulan
                const totalHari = new Date(tahun, parseInt(bulan), 0).getDate();

                for (let i = 1; i <= totalHari; i++) {
                    const val = i.toString().padStart(2, "0");

                    const option = document.createElement("option");
                    option.value = val;
                    option.textContent = i;

                    // jika request('tanggal') cocok → auto selected
                    if (val === "{{ request('tanggal') }}") {
                        option.selected = true;
                    }

                    tanggalSelect.appendChild(option);
                }
            }

            // ⬅ Jalankan saat halaman pertama kali load
            updateTanggal();

            // ⬅ Jalankan setiap kali bulan berubah
            bulanSelect.addEventListener("change", updateTanggal);

        });
    </script>
@endpush
