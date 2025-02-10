@extends('layout.su')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-100 to-purple-100 p-4">
        <div class="w-full max-w-2xl mx-auto">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-8 text-center">
                    @if ($errors->any())
                    <div class="alert alert-danger border-left-danger" role="alert">
                        <ul class="pl-4 my-2">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <h2 class="text-4xl font-bold text-white tracking-tight">Pengembalian Barang</h2>
                </div>
                
                <form action="{{ route('superuser.pengembalianBarang.store') }}" method="POST" class="p-10 space-y-8">
                    @csrf
                    <div>
                        <label for="pb_id" class="block text-lg font-medium text-gray-700 mb-3">Pilih Peminjaman</label>
                        <select name="pb_id" id="pb_id" 
                            class="w-full px-5 py-4 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300"
                            required>
                            <option value="" disabled selected>-- Pilih Peminjaman --</option>
                            @foreach ($peminjaman as $item)
                                <option value="{{ $item->pb_id }}">
                                    {{ $item->siswa->nama_siswa }} - 
                                    {{ $item->peminjamanBarang->pluck('barangInventaris.br_nama')->join(', ') ?: 'Barang Tidak Ditemukan' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="kembali_tgl" class="block text-lg font-medium text-gray-700 mb-3">Tanggal Pengembalian</label>
                        <input type="date" name="kembali_tgl" id="kembali_tgl"
                            class="w-full px-5 py-4 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300"
                            required>
                    </div>

                    <div>
                        <button type="submit" 
                            class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold py-4 rounded-lg hover:opacity-90 transition duration-300 ease-in-out shadow-lg text-lg">
                            Simpan Pengembalian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection