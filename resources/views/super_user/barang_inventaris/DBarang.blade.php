@extends('layout.su')

@section('content')
    <main class="flex-1 p-6">
        <div class="container mx-auto py-8">
            <h1 class="text-2xl font-bold mb-4 text-gray-800">Daftar Barang</h1>
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Nama Barang</th>
                        <th class="px-4 py-2 text-left">Kategori</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $item)
                        <tr class="border-b hover:bg-indigo-50">
                            <td class="px-4 py-2">{{ $item->br_kode }}</td>
                            <td class="px-4 py-2">{{ $item->br_nama }}</td>
                            <td class="px-4 py-2">
                                {{ $item->jenis_barang ? $item->jenis_barang->jns_brg_nama : 'Tidak Ada Kategori' }}</td>
                            <td class="px-4 py-2">
                                <a href="#" class="text-indigo-600 hover:underline">Edit</a> |
                                <a href="#" class="text-red-600 hover:underline">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection


