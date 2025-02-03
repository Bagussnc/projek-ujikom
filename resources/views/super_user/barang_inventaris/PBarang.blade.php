@extends('layout.su')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-100 to-purple-100 p-8">
    <div class="w-full max-w-lg mx-auto">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6 text-center">
                <h2 class="text-xl font-bold text-white">Form Penerimaan Barang</h2>
            </div>
            
            <form action="{{ route('superuser.barangStore') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" id="nama" name="nama" 
                        class="w-full px-4 py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" 
                        placeholder="Masukkan nama barang" required>
                </div>
                
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select id="kategori" name="kategori" required 
                        class="w-full px-4 py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
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
                
                <div>
                    <label for="br_status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="br_status" name="br_status" required 
                        class="w-full px-4 py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        <option value="1">Barang Baik</option>
                        <option value="2">Barang Kurang Baik</option>
                        <option value="3">Barang Rusak</option>
                    </select>
                </div>
                
                <div class="pt-6">
                    <button type="submit" 
                        class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-bold py-3 rounded-lg hover:opacity-90 transition duration-300 ease-in-out shadow-md text-sm">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
