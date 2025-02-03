@extends('layout.su')

@section('content')
<main class="flex-1 p-6 bg-gray-50">
    <div class="container mx-auto py-8">
        <!-- Alert jika ada error -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Daftar Peminjaman -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Peminjaman</h2>
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">Tanggal Peminjaman</th>
                        <th class="px-4 py-2 text-left">Nama Siswa</th>
                        <th class="px-4 py-2 text-left">Nama Barang</th>
                        <th class="px-4 py-2 text-left">Tanggal Harus Kembali</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman as $pinjam)
                    @foreach ($pinjam->peminjamanBarang as $barangPinjam)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $pinjam->pb_tgl->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">{{ $pinjam->siswa->nama_siswa }}</td>
                        <td class="px-4 py-2">{{ $barangPinjam->barangInventaris->br_nama }}</td>
                        <td class="px-4 py-2">{{ $pinjam->pb_harus_kembali_tgl->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">
                            @if ($pinjam->pb_stat === '1')
                            <span class="text-green-600">Peminjaman Aktif</span>
                            @else
                            <span class="text-gray-600">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>

            </table>
        </div>

        <!-- Tombol untuk Membuka Modal -->
        <button id="openModalBtn" class="bg-indigo-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-indigo-700">
            Form Peminjaman
        </button>

        <!-- Modal Form Peminjaman -->
        <div id="modalForm" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">
                <button id="closeModalBtn" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">✕</button>
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Form Peminjaman Barang</h2>
                <form action="{{ route('superuser.simpanPeminjamanBarang') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="siswa_id" class="block text-sm font-semibold text-gray-700">Nama Siswa</label>
                        <select name="siswa_id" id="siswa_id" class="w-full p-2 border rounded">
                            @foreach ($siswa as $item)
                            <option value="{{ $item->siswa_id }}">{{ $item->nama_siswa }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="br_kode" class="block text-sm font-semibold text-gray-700">Nama Barang</label>
                        <select name="br_kode" id="br_kode" class="w-full p-2 border rounded">
                            @foreach ($barang as $item)
                            <option value="{{ $item->br_kode }}">{{ $item->br_nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="pb_tgl" class="block text-sm font-semibold text-gray-700">Tanggal Peminjaman</label>
                        <input type="date" name="pb_tgl" id="pb_tgl" class="w-full p-2 border rounded" required>
                    </div>

                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg">Pinjam Barang</button>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const modalForm = document.getElementById('modalForm');

    // Buka modal
    openModalBtn.addEventListener('click', (e) => {
        e.preventDefault();
        modalForm.classList.remove('hidden');
    });

    // Tutup modal
    closeModalBtn.addEventListener('click', (e) => {
        e.preventDefault();
        modalForm.classList.add('hidden');
    });

    // Klik di luar modal
    window.addEventListener('click', (e) => {
        if (e.target === modalForm) {
            modalForm.classList.add('hidden');
        }
    });
</script>
@endsection