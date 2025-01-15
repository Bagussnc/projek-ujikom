<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tm_user')->insert([
            [
                'user_id' => 'USR000000000000000001', // 20 karakter
                'user_nama' => 'John Doe',
                'user_pass' => bcrypt('password123'),
                'user_hak' => '01', // Hak akses, misalnya Admin
                'user_sts' => '01', // Status aktif
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 'USR000000000000000002', // 20 karakter
                'user_nama' => 'Jane Smith',
                'user_pass' => bcrypt('password123'),
                'user_hak' => '02', // Hak akses, misalnya User
                'user_sts' => '01', // Status aktif
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 'USR000000000000000003', // 20 karakter
                'user_nama' => 'Michael Johnson',
                'user_pass' => bcrypt('password123'),
                'user_hak' => '02', // Hak akses, misalnya User
                'user_sts' => '01', // Status aktif
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 'USR000000000000000004', // 20 karakter
                'user_nama' => 'Emily Davis',
                'user_pass' => bcrypt('password123'),
                'user_hak' => '01', // Hak akses, misalnya Admin
                'user_sts' => '01', // Status aktif
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 'USR000000000000000005', // 20 karakter
                'user_nama' => 'David Wilson',
                'user_pass' => bcrypt('password123'),
                'user_hak' => '02', // Hak akses, misalnya User
                'user_sts' => '01', // Status aktif
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
