@extends('layout.su')

@section('content')
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Form Pengembalian Barang</h2>
        <form action="{{ route('superuser.pengembalianBarang.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="flex flex-col">
                <label for="pb_id" class="text-gray-600 font-medium mb-1">Pilih Peminjaman</label>
                <select name="pb_id" id="pb_id"
                    class="border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Peminjaman --</option>
                    @foreach ($peminjaman as $item)
                        <option value="{{ $item->pb_id }}">
                            {{ $item->siswa->nama_siswa }} -
                            {{ $item->peminjamanBarang[0]->barangInventaris->br_nama ?? 'Barang Tidak Ditemukan' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col">
                <label for="kembali_tgl" class="text-gray-600 font-medium mb-1">Tanggal Pengembalian</label>
                <input type="date" name="kembali_tgl" id="kembali_tgl"
                    class="border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-500 text-white font-medium px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
                    Simpan Pengembalian
                </button>
            </div>
        </form>
    </div>
@endsection
