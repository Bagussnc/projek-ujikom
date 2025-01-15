<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangInventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tm_barang_inventaris')->insert([
            [
                'br_kode' => 'BRG000001',
                'jns_brg_kode' => 'BRG01', // Elektronik
                'user_id' => '00000000000000000001',
                'br_nama' => 'Laptop Dell XPS',
                'br_tgl_terima' => '2023-01-10',
                'br_tgl_entry' => now(),
                'br_status' => 'AK', // Aktif
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'br_kode' => 'BRG000002',
                'jns_brg_kode' => 'BRG02', // Perabotan
                'user_id' => '00000000000000000001',
                'br_nama' => 'Meja Kerja',
                'br_tgl_terima' => '2023-02-15',
                'br_tgl_entry' => now(),
                'br_status' => 'AK',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'br_kode' => 'BRG000003',
                'jns_brg_kode' => 'BRG03', // Kendaraan
                'user_id' => '00000000000000000001',
                'br_nama' => 'Sepeda Motor Yamaha',
                'br_tgl_terima' => '2023-03-20',
                'br_tgl_entry' => now(),
                'br_status' => 'AK',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'br_kode' => 'BRG000004',
                'jns_brg_kode' => 'BRG04', // Alat Tulis
                'user_id' => '00000000000000000001',
                'br_nama' => 'Paket Pulpen',
                'br_tgl_terima' => '2023-04-25',
                'br_tgl_entry' => now(),
                'br_status' => 'AK',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'br_kode' => 'BRG000005',
                'jns_brg_kode' => 'BRG05', // Furnitur
                'user_id' => '00000000000000000001',
                'br_nama' => 'Kursi Kantor',
                'br_tgl_terima' => '2023-05-30',
                'br_tgl_entry' => now(),
                'br_status' => 'AK',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
