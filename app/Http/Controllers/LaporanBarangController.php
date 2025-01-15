<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangInventaris;
use App\Models\JenisBarang;
use App\Models\Peminjaman;

class LaporanBarangController extends Controller
{
    public function laporanBarang(Request $request)
    {
        // Ambil parameter filter dari request
        $jenisBarang = $request->input('jns_brg');
        $periode = $request->input('periode');

        // Query untuk mendapatkan data barang inventaris
        $query = BarangInventaris::query();

        // Filter berdasarkan jenis barang jika ada
        if ($jenisBarang) {
            $query->where('jns_brg_kode', $jenisBarang);
        }

        // Filter berdasarkan periode jika ada
        if ($periode) {
            $query->whereDate('br_tgl_terima', 'like', $periode . '%');
        }

        // Ambil data barang inventaris yang sudah difilter
        $barangInventaris = $query->with('jenis_barang')->get();

        // Ambil data jenis barang untuk dropdown
        $jenisBarangs = JenisBarang::all();

        // Jika tidak ada data, kirimkan pesan
        if ($barangInventaris->isEmpty()) {
            $message = 'Tidak ada barang yang ditemukan.';
        } else {
            $message = '';
        }

        return view('super_user.laporan.laporanBarang', compact('barangInventaris', 'jenisBarangs', 'message'));
    }

    // Laporan Peminjaman lainnya
    public function laporanPeminjaman(Request $request)
    {
        // Ambil parameter filter dari request
        $siswaName = $request->input('siswa');
        $tanggalPeminjaman = $request->input('tanggal_peminjaman');
        $statusPeminjaman = $request->input('status_peminjaman');

        // Query untuk mendapatkan data peminjaman
        $query = Peminjaman::query();

        // Filter berdasarkan nama siswa jika ada
        if ($siswaName) {
            $query->whereHas('siswa', function ($q) use ($siswaName) {
                $q->where('nama_siswa', 'like', '%' . $siswaName . '%');
            });
        }

        // Filter berdasarkan tanggal peminjaman jika ada
        if ($tanggalPeminjaman) {
            $query->whereDate('pb_tgl', $tanggalPeminjaman);
        }

        // Filter berdasarkan status peminjaman jika ada
        if ($statusPeminjaman) {
            $query->where('pb_stat', $statusPeminjaman);
        }

        // Ambil data peminjaman dengan relasi siswa dan barang
        $peminjamanData = $query->with(['siswa', 'peminjamanBarang.barangInventaris'])->get();

        // Kirimkan data ke view
        return view('super_user.laporan.laporanPeminjaman', compact('peminjamanData'));
    }
}
