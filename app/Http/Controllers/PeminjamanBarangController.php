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
            $tanggalKembali = $tanggalPeminjaman->copy()->addWeek();

            DB::beginTransaction();

            // Data utama peminjaman
            $peminjaman = Peminjaman::create([
                'pb_id' => 'PB' . strtoupper(uniqid()),
                'siswa_id' => $request->siswa_id,
                'pb_tgl' => $tanggalPeminjaman,
                'pb_harus_kembali_tgl' => $tanggalKembali,
                'pb_stat' => '1',
            ]);

            // Data peminjaman barang
            PeminjamanBarang::create([
                'pbd_id' => 'PBD' . strtoupper(uniqid()),
                'pb_id' => $peminjaman->pb_id,
                'br_kode' => $request->br_kode,
                'pdb_tgl' => $tanggalPeminjaman,
                'pdb_sts' => '1',
            ]);

            // Update status barang
            BarangInventaris::where('br_kode', $request->br_kode)->update(['br_status' => '0']);

            DB::commit();

            return redirect()->route('superuser.peminjamanBarang')->with('success', 'Peminjaman barang berhasil dilakukan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
