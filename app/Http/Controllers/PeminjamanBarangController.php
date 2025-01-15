<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\PeminjamanBarang;
use App\Models\BarangInventaris;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PeminjamanBarangController extends Controller
{
    public function peminjamanBarang()
    {
        $peminjaman = Peminjaman::with(['siswa', 'peminjamanBarang.barangInventaris'])->get();
        $barang = BarangInventaris::where('br_status', '1')->get(); 
        $siswa = Siswa::all(); 

        return view('super_user.peminjaman_barang.peminjaman', compact('barang', 'siswa', 'peminjaman'));
    }

    public function simpanPeminjamanBarang(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,siswa_id',
            'br_kode' => 'required|exists:tm_barang_inventaris,br_kode',
            'pb_tgl' => 'required|date_format:Y-m-d',
        ]);

        try {
            $tanggalPeminjaman = Carbon::createFromFormat('Y-m-d', $request->pb_tgl);

            $tanggalKembali = $tanggalPeminjaman->addWeek(); 

            DB::beginTransaction();

            // Menyimpan data peminjaman utama
            $peminjaman = new Peminjaman();
            $peminjaman->pb_id = 'PB' . strtoupper(uniqid()); 
            $peminjaman->siswa_id = $request->siswa_id;
            $peminjaman->pb_tgl = $tanggalPeminjaman;
            $peminjaman->pb_harus_kembali_tgl = $tanggalKembali; 
            $peminjaman->pb_stat = '01';
            $peminjaman->save();

            // Menyimpan data peminjaman barang terkait
            $peminjamanBarang = new PeminjamanBarang();
            $peminjamanBarang->pbd_id = 'PBD' . strtoupper(uniqid());
            $peminjamanBarang->pb_id = $peminjaman->pb_id;
            $peminjamanBarang->br_kode = $request->br_kode;
            $peminjamanBarang->pdb_tgl = $tanggalPeminjaman; 
            $peminjamanBarang->pdb_sts = '01'; 
            $peminjamanBarang->save();

            // Mengubah status barang menjadi tidak tersedia
            $barang = BarangInventaris::findOrFail($request->br_kode);
            $barang->br_status = '00'; 
            $barang->save();

            // Commit transaksi jika tidak ada error
            DB::commit();

            return redirect()->route('superuser.peminjamanBarang')->with('success', 'Peminjaman barang berhasil dilakukan!');
        } catch (\Exception $e) {
            // Rollback jika ada error
            DB::rollBack();
            return back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
