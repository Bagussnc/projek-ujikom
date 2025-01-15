@extends('layout.su')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-semibold text-gray-800 mb-4">Daftar Jenis Barang</h2>
        <div class="mb-4 flex justify-end">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none"
                data-bs-toggle="modal" data-bs-target="#addJenisBarangModal">
                Tambah Jenis Barang
            </button>
        </div>
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">ID</th>
                    <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Nama Jenis Barang</th>
                    <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Deskripsi</th>
                    <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data jenis barang akan di-loop di sini -->
                <tr class="border-t border-gray-100">
                    <td class="py-3 px-4 text-sm text-gray-700">1</td>
                    <td class="py-3 px-4 text-sm text-gray-700">Elektronik</td>
                    <td class="py-3 px-4 text-sm text-gray-700">Barang-barang elektronik seperti televisi, kulkas, dll.</td>
                    <td class="py-3 px-4 text-sm">
                        <button
                            class="bg-yellow-500 text-white px-3 py-1 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none"
                            data-bs-toggle="modal" data-bs-target="#editJenisBarangModal">Edit</button>
                        <button
                            class="bg-red-500 text-white px-3 py-1 rounded-lg shadow-md hover:bg-red-600 focus:outline-none">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Jenis Barang -->
    <div class="modal fade px-6 pb-6" id="addJenisBarangModal" tabindex="-1" aria-labelledby="addJenisBarangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-xl font-semibold" id="addJenisBarangModalLabel">Tambah Jenis Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-4">
                            <label for="jenisBarangNama" class="block text-sm font-medium text-gray-700">Nama Jenis
                                Barang</label>
                            <input type="text"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                id="jenisBarangNama" required>
                        </div>
                        <div class="mb-4">
                            <label for="jenisBarangDeskripsi"
                                class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                id="jenisBarangDeskripsi" rows="3" required></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-500 text-white py-2 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
