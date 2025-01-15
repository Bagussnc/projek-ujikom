<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReferensiController extends Controller
{
    public function jenisbarang(){
        return view('super_user.referensi.jenisBarang');
    }

    public function daftarPengguna(){
        return view('super_user.referensi.daftarPengguna');
    }
}
