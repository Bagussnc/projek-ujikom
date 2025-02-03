<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
                'user_id' => Str::random(10),
                'user_nama' => 'admin',
                'user_pass' => Hash::make('password123'),
                'user_hak' => 'admin',
                'user_sts' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => Str::random(10),
                'user_nama' => 'superuser',
                'user_pass' => Hash::make('password123'),
                'user_hak' => 'su',
                'user_sts' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
