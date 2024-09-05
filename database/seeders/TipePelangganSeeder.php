<?php

namespace Database\Seeders;

use App\Models\tipePelanggan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TipePelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Pastikan tabel kosong sebelum mengisi data

     
      

        $tipepelanggans = [
            ['kodeType' => 'P1', 'name' => 'Karyawan'],
            ['kodeType' => 'P2', 'name' => 'Perusahaan'],
            ['kodeType' => 'P3', 'name' => 'Afiliasi'],
            ['kodeType' => 'P4', 'name' => 'Pemerintah'],
            ['kodeType' => 'P5', 'name' => 'Agen Travel'],
            ['kodeType' => 'P6', 'name' => 'Orang Pribadi'],
            ['kodeType' => 'P7', 'name' => 'ATPM/APM'],
            ['kodeType' => 'P8', 'name' => 'Part Shop'],
            ['kodeType' => 'P9', 'name' => 'Leasing'],
            ['kodeType' => 'P10', 'name' => 'Lainnya'],
        ];

        foreach ($tipepelanggans as $tipe) {
            DB::table('tipepelanggan')->insert([
                'kodeType' => $tipe['kodeType'],
                'name' => $tipe['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
