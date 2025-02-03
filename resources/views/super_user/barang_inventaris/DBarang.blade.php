@extends('layout.su')

@section('content')
    <main class="flex-1 p-6">
        <div class="container mx-auto py-8">
            <h1 class="text-3xl font-extrabold mb-6 text-gray-800 border-b-2 border-indigo-600 pb-2">Daftar Barang</h1>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-lg rounded-lg">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Nama Barang</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach ($barang as $item)
                        <tr class="hover:bg-indigo-100 transition ease-in-out duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 text-sm font-medium">{{ $item->br_kode }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 text-sm">{{ $item->br_nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 text-sm">
                                {{ $item->jenis_barang ? $item->jenis_barang->jns_brg_nama : 'Tidak Ada Kategori' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="inline-block px-3 py-1 rounded-full text-white 
                                    @if ($item->br_status == 1) bg-green-500 @elseif ($item->br_status == 2) bg-yellow-500 @elseif ($item->br_status == 3) bg-red-500 @else bg-gray-400 @endif">
                                    @if ($item->br_status == 1)
                                        Barang Baik
                                    @elseif ($item->br_status == 2)
                                        Barang Kurang Baik
                                    @elseif ($item->br_status == 3)
                                        Barang Rusak
                                    @else
                                        Tidak Diketahui
                                    @endif
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="#" class="text-indigo-600 hover:text-indigo-800 font-semibold">Edit</a>
                                <span class="mx-2">|</span>
                                <a href="#" class="text-red-600 hover:text-red-800 font-semibold">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
