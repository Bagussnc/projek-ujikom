@extends('layout.su')

@section('content')
    <div class="p-6 bg-gray-100">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Laporan Barang</h1>

        <!-- Filter Section -->
        <div class="bg-white shadow-lg rounded-lg p-8 mb-8 max-w-6xl mx-auto">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Filter Laporan Barang</h2>
            <form action="{{ route('superuser.laporanBarang') }}" method="GET"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- jns_brg -->
                <div class="relative">
                    <label for="jns_brg" class="block text-sm font-medium text-gray-600 mb-2">Jenis Barang</label>
                    <select id="jns_brg" name="jns_brg"
                        class="block w-full border border-gray-300 rounded-lg shadow-sm text-gray-600 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out transform hover:scale-105 hover:border-indigo-400">
                        <option value="">Semua</option>
                        @foreach ($jenisBarangs as $jenis)
                            <option value="{{ $jenis->jns_brg_kode }}"
                                {{ request('jns_brg') == $jenis->jns_brg_kode ? 'selected' : '' }}>
                                {{ $jenis->jns_brg_nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Periode -->
                <div class="relative">
                    <label for="periode" class="block text-sm font-medium text-gray-600 mb-2">Periode</label>
                    <input type="month" id="periode" name="periode"
                        class="block w-full border border-gray-300 rounded-lg shadow-sm text-gray-600 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out transform hover:scale-105 hover:border-indigo-400"
                        value="{{ request('periode') }}">
                </div>

                <!-- Tombol Cari -->
                <div class="flex justify-center sm:col-span-3 mt-6">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-8 py-3 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none transition duration-300 transform hover:scale-105 hover:shadow-lg">
                        Tampilkan Laporan
                    </button>
                </div>
            </form>
        </div>

        <!-- Pesan Jika Tidak Ada Data -->
        @if (!empty($message))
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg mb-6">
                {{ $message }}
            </div>
        @endif

        <!-- Laporan Table -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Hasil Laporan</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700">No</th>
                            <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700">Nama Barang</th>
                            <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700">Jenis Barang</th>
                            <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700">Tanggal Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangInventaris as $index => $barang)
                            <tr class="border-b">
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $barang->br_nama }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $barang->jenis_barang->jns_brg_nama }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $barang->br_tgl_terima }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
