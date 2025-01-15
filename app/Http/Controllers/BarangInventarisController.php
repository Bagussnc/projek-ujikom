<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangInventaris;
use App\Models\JenisBarang;
use App\Models\Peminjaman;

class BarangInventarisController extends Controller
{
    public function daftarBarang()
    {
        return view('super_user.barang_inventaris/DBarang');
    }
    public function penerimaanBarang()
    {
        return view('super_user.barang_inventaris.PBarang');
    }
    public function laporanBarang()
    {
        return view('super_user.laporan.laporanBarang');
    }
    public function laporanPeminjaman()
    {
        return view('super_user.laporan.laporanPeminjaman');
    }

    public function DBarang()
    {
        $barang = BarangInventaris::with('jenis_barang')->get();

        return view('super_user.barang_inventaris.DBarang', compact('barang'));
    }

    public function PBarang()
    {
        $barang = BarangInventaris::with('jenis_barang')->get();

        $jenisBarang = JenisBarang::all();

        return view('super_user.barang_inventaris.PBarang', compact('barang', 'jenisBarang'));
    }

    public function barangStore(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|exists:tr_jenis_barang,jns_brg_kode',
        ]);

        try {
            // Tahun berjalan
            $thn_sekarang = now()->format('Y');

            // Mendapatkan nomor urut terakhir berdasarkan tahun berjalan
            $no_urut = BarangInventaris::whereRaw("SUBSTRING(br_kode, 4, 4) = ?", [$thn_sekarang])
                ->selectRaw("IFNULL(MAX(SUBSTRING(br_kode, 8, 5)), 0) + 1 AS no_urut")
                ->value('no_urut');

            // Format nomor urut dengan padding 5 digit (contoh: 00001)
            $no_urut_padded = str_pad($no_urut, 5, '0', STR_PAD_LEFT);

            // Membuat kode barang
            $br_kode = "INV{$thn_sekarang}{$no_urut_padded}";

            // Simpan data ke database
            BarangInventaris::create([
                'br_kode' => $br_kode,
                'jns_brg_kode' => $request->kategori,
                'user_id' => auth()->id(),
                'br_nama' => $request->nama,
                'br_tgl_terima' => now(),
                'br_tgl_entry' => now(),
                'br_status' => 1,
            ]);

            return redirect()->route('superuser.daftarBarang')->with('success', 'Barang berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menambahkan barang. Silakan coba lagi.'])->withInput();
        }
    }
}
