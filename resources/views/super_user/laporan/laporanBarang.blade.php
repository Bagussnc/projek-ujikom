@extends('layout.su')

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">
        <h1 class="text-4xl font-bold text-gray-900 mb-10 text-center"> Laporan Barang</h1>

<!-- Filter Section -->
<div class="bg-white shadow-2xl rounded-3xl p-12 mb-12 max-w-6xl mx-auto border border-gray-300">
            <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center tracking-wide"> Filter Laporan Barang</h2>
            <form action="{{ route('superuser.laporanBarang') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- jns_brg -->
                <div class="relative">
                    <label for="jns_brg" class="block text-sm font-medium text-gray-700 mb-2">Jenis Barang</label>
                    <select id="jns_brg" name="jns_brg" class="block w-full border border-gray-300 rounded-xl p-4 shadow-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 hover:shadow-lg bg-gray-50">
                        <option value="">Semua</option>
                        @foreach ($jenisBarangs as $jenis)
                            <option value="{{ $jenis->jns_brg_kode }}" {{ request('jns_brg') == $jenis->jns_brg_kode ? 'selected' : '' }}>
                                {{ $jenis->jns_brg_nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Periode -->
                <div class="relative">
                    <label for="periode" class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                    <input type="month" id="periode" name="periode" class="block w-full border border-gray-300 rounded-xl p-4 shadow-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 hover:shadow-lg bg-gray-50" value="{{ request('periode') }}">
                </div>

                <!-- Tombol Cari -->
                <div class="flex justify-center sm:col-span-3 mt-8">
                    <button type="submit" class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white px-12 py-4 rounded-xl shadow-xl hover:from-indigo-600 hover:to-blue-600 focus:outline-none transition duration-300 transform hover:scale-110 hover:shadow-2xl">
                         Tampilkan Laporan
                    </button>
                </div>
            </form>
        </div>

        <!-- Pesan Jika Tidak Ada Data -->
        @if (!empty($message))
            <div class="bg-yellow-100 text-yellow-900 p-4 rounded-lg mb-6 shadow-md text-center">
                 {{ $message }}
            </div>
        @endif

        <!-- Laporan Table -->
        <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-300">
            <h2 class="text-xl font-semibold text-gray-800 mb-6 text-center"> Hasil Laporan</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow">
                    <thead>
                        <tr class="bg-gradient-to-r from-gray-100 to-gray-200 border-b text-gray-700">
                            <th class="text-left px-6 py-4 text-sm font-semibold">No</th>
                            <th class="text-left px-6 py-4 text-sm font-semibold">Nama Barang</th>
                            <th class="text-left px-6 py-4 text-sm font-semibold">Jenis Barang</th>
                            <th class="text-left px-6 py-4 text-sm font-semibold">Tanggal Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangInventaris as $index => $barang)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $barang->br_nama }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $barang->jenis_barang->jns_brg_nama }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $barang->br_tgl_terima }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
