<?php

namespace App\Http\Controllers;

use App\Models\BarangInventaris;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class SuperUserController extends Controller
{
    public function index(){
        return view('super_user.dashboard');
    }

    public function jumlahBarang()
    {
        $jumlahBarang = BarangInventaris::count();
        $jumlahPeminjaman = Peminjaman::count();  
        
        $peminjamanPerBulan = Peminjaman::selectRaw('MONTH(pb_tgl) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $dataGrafik = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataGrafik[] = $peminjamanPerBulan[$i] ?? 0; 
        }

        return view('super_user.dashboard', compact('jumlahBarang', 'jumlahPeminjaman', 'dataGrafik'));
    }
}
