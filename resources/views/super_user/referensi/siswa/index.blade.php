@extends('layout.su')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Daftar Siswa</h1>
        <a href="{{ route('superuser.siswa.create') }}" class="inline-block bg-blue-500 text-white py-2 px-5 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">
            Tambah Siswa
        </a>
    </div>

    <!-- Success Message -->
    @if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 shadow">
        <p class="font-semibold">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-lg border border-gray-200">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="px-4 py-3 text-left text-sm font-semibold">#</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">NISN</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Nama Siswa</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Jurusan</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Kelas</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">No Siswa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $index => $data)
                <tr class="hover:bg-gray-100 transition duration-200">
                    <td class="px-4 py-3 border-b text-gray-700">{{ $index + 1 }}</td>
                    <td class="px-4 py-3 border-b text-gray-700">{{ $data->nisn }}</td>
                    <td class="px-4 py-3 border-b text-gray-700">{{ $data->nama_siswa }}</td>
                    <td class="px-4 py-3 border-b text-gray-700">{{ $data->jurusan->nama_jurusan }}</td>
                    <td class="px-4 py-3 border-b text-gray-700">{{ $data->kelas->nama_kelas }}</td>
                    <td class="px-4 py-3 border-b text-gray-700">{{ $data->no_siswa ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
