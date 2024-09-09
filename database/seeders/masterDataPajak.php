<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class masterDataPajak extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('masterdatapajak')->insert([
            [
                'name' => 'PPN',
                'nilai' => 11.00, // Represents 10%
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PPh 23',
                'nilai' => 2.00, // Represents 2%
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PPh 4(2)',
                'nilai' => 10.00, // Represents 11%
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
