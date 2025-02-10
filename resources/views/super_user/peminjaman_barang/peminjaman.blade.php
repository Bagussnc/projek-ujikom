@extends('layout.su')

@section('content')
<main class="flex-1 p-6 bg-gray-50">

    <style>
        #barangList {
            max-height: 173px; /* Menampilkan hanya 4 item, sisanya bisa di-scroll */
            overflow-y: auto;
            display: block;
        }
        #selectedItems {
            max-height: 173px; /* Batasi tinggi daftar */
            overflow-y: auto;  /* Tambahkan scroll jika penuh */
            min-height: 50px; /* Supaya tetap terlihat meskipun kosong */
        }
    </style>


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



        <!-- Tombol untuk Membuka Modal -->
        <button id="openModalBtn" class="bg-indigo-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-indigo-700 mb-4">
            Form Peminjaman
        </button>

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
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $pinjam->pb_tgl->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">{{ $pinjam->siswa->nama_siswa }}</td>
                        <td class="px-4 py-2">
                            {{ $pinjam->peminjamanBarang->pluck('barangInventaris.br_nama')->join(', ') }}
                        </td>
                        <td class="px-4 py-2">{{ $pinjam->pb_harus_kembali_tgl->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">
                            @if ($pinjam->pb_stat === '1')
                            <span class="text-green-600">Peminjaman Aktif</span>
                            @else
                            <span class="text-gray-600">Peminjaman Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

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
                        <label class="block text-sm font-semibold text-gray-700">Pilih Barang</label>
                        <ul id="barangList" class="border p-2 rounded bg-gray-100">
                            @foreach ($barang as $item)
                            <li class="flex items-center justify-between p-2 bg-white rounded shadow mb-2">
                                <span>{{ $item->br_nama }}</span>
                                <button type="button" class="toggle-item bg-green-500 text-white px-3 py-1 rounded" data-id="{{ $item->br_kode }}" data-name="{{ $item->br_nama }}">+</button>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700">Barang yang Dipilih</label>
                        <ul id="selectedItems" class="border p-2 rounded bg-gray-100"></ul>
                        <div id="hiddenInputsContainer">
                            <input type="hidden" name="br_kode[]" id="barangDipilihInput">
                        </div>
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
     document.getElementById('openModalBtn').addEventListener('click', function() {
        document.getElementById('modalForm').classList.remove('hidden');
    });

    document.getElementById('closeModalBtn').addEventListener('click', function() {
        document.getElementById('modalForm').classList.add('hidden');
    });

    document.addEventListener('click', function(e) {
        if (e.target === document.getElementById('modalForm')) {
            document.getElementById('modalForm').classList.add('hidden');
        }
    });

    function updateHiddenInput() {
        let selectedItems = document.querySelectorAll('#selectedItems li');
        let selectedIds = Array.from(selectedItems).map(item => item.getAttribute('data-id'));

        console.log(selectedIds)

        let inputContainer = document.getElementById('hiddenInputsContainer');
        inputContainer.innerHTML = ''; // Kosongkan dulu

        if (selectedIds.length > 0) {
            selectedIds.forEach(id => {
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'br_kode[]'; // Array input
                input.value = id;
                inputContainer.appendChild(input);
            });
        } else {
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'br_kode[]';
            input.value = ''; // Pastikan ada input kosong jika tidak ada barang dipilih
            inputContainer.appendChild(input);
        }
    }

    document.querySelectorAll('.toggle-item').forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let name = this.getAttribute('data-name');
            let selectedList = document.getElementById('selectedItems');

            if (this.innerText === '+') {
                let newItem = document.createElement('li');
                newItem.classList.add('flex', 'items-center', 'justify-between', 'p-2', 'bg-white', 'rounded', 'shadow', 'mb-2');
                newItem.setAttribute('data-id', id);
                newItem.innerHTML = `<span>${name}</span>`;
                selectedList.appendChild(newItem);
                this.innerText = '-';
                this.classList.replace('bg-green-500', 'bg-red-500');
            } else {
                let items = selectedList.querySelectorAll('li');
                items.forEach(item => {
                    if (item.getAttribute('data-id') === id) {
                        item.remove();
                    }
                });
                this.innerText = '+';
                this.classList.replace('bg-red-500', 'bg-green-500');
            }

            updateHiddenInput(); // 🔥 Pastikan input hidden diperbarui setiap kali item dipilih
        });
    });



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