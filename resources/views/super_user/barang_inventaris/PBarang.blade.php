@extends('layout.su')

@section('content')
    <div class="container mx-auto py-8 px-4">

        <!-- Form Penerimaan Barang -->
        <div class="bg-gradient-to-r from-indigo-500 to-blue-500 p-8 shadow-xl rounded-lg w-full mb-8">
            <h2 class="text-3xl font-bold mb-6 text-white text-center">Form Penerimaan Barang</h2>
            <form action="{{ route('superuser.barangStore') }}" method="POST"
                class="space-y-6 bg-white p-6 rounded-lg shadow-md">
                @csrf
                <div>
                    <label for="nama" class="block text-gray-700 text-sm font-semibold">Nama Barang</label>
                    <input type="text" id="nama" name="nama"
                        class="w-full border-2 border-gray-300 rounded-md px-4 py-2 text-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Masukkan nama barang" required>
                </div>
                <div>
                    <label for="kategori" class="block text-gray-700 text-sm font-semibold">Kategori</label>
                    <select id="kategori" name="kategori" required
                        class="w-full border-2 border-gray-300 rounded-md px-4 py-2 text-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Pilih Kategori</option>
                        @if (isset($jenisBarang) && $jenisBarang->count())
                            @foreach ($jenisBarang as $kategori)
                                <option value="{{ $kategori->jns_brg_kode }}">{{ $kategori->jns_brg_nama }}</option>
                            @endforeach
                        @else
                            <option value="" disabled>Tidak ada kategori tersedia</option>
                        @endif
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-indigo-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-200">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
