@extends('layout.su')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Daftar Pengguna</h2>
        <div class="mb-4 flex justify-end">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none"
                data-bs-toggle="modal" data-bs-target="#addPenggunaModal">
                Tambah Pengguna
            </button>
        </div>
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">ID</th>
                    <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Nama Pengguna</th>
                    <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Email</th>
                    <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Role</th>
                    <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data pengguna akan di-loop di sini -->
                <tr class="border-t border-gray-100">
                    <td class="py-3 px-4 text-sm text-gray-700">1</td>
                    <td class="py-3 px-4 text-sm text-gray-700">John Doe</td>
                    <td class="py-3 px-4 text-sm text-gray-700">johndoe@example.com</td>
                    <td class="py-3 px-4 text-sm text-gray-700">Admin</td>
                    <td class="py-3 px-4 text-sm">
                        <button
                            class="bg-yellow-500 text-white px-3 py-1 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none"
                            data-bs-toggle="modal" data-bs-target="#editPenggunaModal">Edit</button>
                        <button
                            class="bg-red-500 text-white px-3 py-1 rounded-lg shadow-md hover:bg-red-600 focus:outline-none">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Pengguna -->
    <div class="modal fade px-6 pb-6" id="addPenggunaModal" tabindex="-1" aria-labelledby="addPenggunaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-xl font-semibold" id="addPenggunaModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-4">
                            <label for="penggunaNama" class="block text-sm font-medium text-gray-700">Nama Pengguna</label>
                            <input type="text"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                id="penggunaNama" required>
                        </div>
                        <div class="mb-4">
                            <label for="penggunaEmail" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                id="penggunaEmail" required>
                        </div>
                        <div class="mb-4">
                            <label for="penggunaRole" class="block text-sm font-medium text-gray-700">Role</label>
                            <select
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                id="penggunaRole" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-500 text-white py-2 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
