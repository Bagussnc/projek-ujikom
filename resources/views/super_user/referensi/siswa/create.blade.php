@extends('layout.su')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-100 to-purple-100 p-4">
    <div class="w-full max-w-lg mx-auto">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 text-center">
                <h1 class="text-2xl font-bold text-white tracking-tight">Tambah Siswa Baru</h1>
            </div>

            @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 m-4 text-sm" role="alert">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('superuser.siswa.store') }}" method="POST" class="p-6 space-y-4">
                @csrf

                <div>
                    <label for="nisn" class="block text-sm font-medium text-gray-700 mb-2">NISN</label>
                    <input type="text" name="nisn" id="nisn" 
                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" 
                        value="{{ old('nisn') }}" required>
                </div>

                <div>
                    <label for="nama_siswa" class="block text-sm font-medium text-gray-700 mb-2">Nama Siswa</label>
                    <input type="text" name="nama_siswa" id="nama_siswa" 
                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" 
                        value="{{ old('nama_siswa') }}" required>
                </div>

                <div>
                    <label for="jurusan_id" class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                    <select name="jurusan_id" id="jurusan_id" 
                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" 
                        required>
                        <option value="">Pilih Jurusan</option>
                        @foreach ($jurusan as $j)
                        <option value="{{ $j->id }}" {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>
                            {{ $j->nama_jurusan }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                    <select name="kelas_id" id="kelas_id" 
                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" 
                        required>
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelas as $k)
                        <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="no_siswa" class="block text-sm font-medium text-gray-700 mb-2">No Siswa</label>
                    <input type="text" name="no_siswa" id="no_siswa" 
                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" 
                        value="{{ old('no_siswa') }}">
                </div>

                <div>
                    <button type="submit" 
                        class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold py-3 rounded-md hover:opacity-90 transition duration-300 ease-in-out shadow-md text-sm">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
