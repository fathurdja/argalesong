<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class masterDataPiutang extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('masterpiutang')->insert([
            [
                'idpelanggan' => 'PRSH-929678',
                'tagihan' => 600000, // Represents 10%
                'totaldiskon' => 120000,
                'ppn' => 660000,
                'totalpiutang' => 6540000,
                'kode_Piutang' => '',
            ],
            [
                'idpelanggan' => 'PRSH-929678',
                'tagihan' => 6000000, // Represents 10%
                'totaldiskon' => 120000,
                'ppn' => 660000,
                'totalpiutang' => 6540000,
                'kode_Piutang' => '',
            ],
           
        ]);
    }
}
