<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DummyMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dummy_masters')->insert([
            [
                'nomor_bukti' => '001',
                'vendor' => 'Vendor A',
                'tanggal_trans' => Carbon::parse('2024-08-01'),
                'tanggal_exp' => Carbon::parse('2024-08-10'),
                'harga' => 100000
            ],
            [
                'nomor_bukti' => '002',
                'vendor' => 'Vendor B',
                'tanggal_trans' => Carbon::parse('2024-08-02'),
                'tanggal_exp' => Carbon::parse('2024-08-11'),
                'harga' => 150000
            ],
            [
                'nomor_bukti' => '003',
                'vendor' => 'Vendor C',
                'tanggal_trans' => Carbon::parse('2024-08-03'),
                'tanggal_exp' => Carbon::parse('2024-08-12'),
                'harga' => 200000
            ],
        ]);
    }
}
