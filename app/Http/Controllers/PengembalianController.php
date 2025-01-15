<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\BarangInventaris;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengembalianController extends Controller
{

    public function index(){
        return view('super_user.peminjaman_barang.pengembalian');
    }
    /**
     * Menampilkan form untuk pengembalian barang.
     */
    public function formPengembalian()
    {
        // Ambil daftar peminjaman yang belum dikembalikan
        $peminjaman = Peminjaman::with(['siswa', 'peminjamanBarang.barangInventaris'])
            ->where('pb_stat', '01') // Status "01" untuk belum dikembalikan
            ->get();

        return view('super_user.peminjaman_barang.pengembalian', compact('peminjaman'));
    }

    /**
     * Menyimpan data pengembalian barang.
     */
    public function simpanPengembalian(Request $request)
    {
        $validated = $request->validate([
            'pb_id' => 'required|exists:tm_peminjaman,pb_id',
            'kembali_tgl' => 'required|date_format:Y-m-d',
        ]);

        try {
            DB::beginTransaction();

            // Simpan data pengembalian
            $pengembalian = new Pengembalian();
            $pengembalian->kembali_id = 'KB' . strtoupper(uniqid());
            $pengembalian->pb_id = $request->pb_id;
            $pengembalian->user_id = auth()->id(); // User yang melakukan pengembalian
            $pengembalian->kembali_tgl = $request->kembali_tgl;
            $pengembalian->kembali_sts = '00'; // Status "02" untuk dikembalikan
            $pengembalian->save();

            // Perbarui status peminjaman menjadi selesai
            $peminjaman = Peminjaman::findOrFail($request->pb_id);
            $peminjaman->pb_stat = '00'; // Status "02" untuk selesai
            $peminjaman->save();

            // Perbarui status barang menjadi tersedia
            foreach ($peminjaman->peminjamanBarang as $peminjamanBarang) {
                $barang = BarangInventaris::findOrFail($peminjamanBarang->br_kode);
                $barang->br_status = '01'; // Status "01" untuk tersedia
                $barang->save();
            }

            DB::commit();

            return redirect()->route('superuser.formPengembalian')->with('success', 'Pengembalian barang berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
