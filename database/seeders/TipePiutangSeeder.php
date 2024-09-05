<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipePiutangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipe_piutangs')->insert([
            ['name' => 'Karyawan'],
            ['name' => 'Afiliasi'],
            ['name' => 'Sewa-menyewa'],
            ['name' => 'Sharing Revenue'],
            ['name' => 'Agen Travel'],
            ['name' => 'Padi Residence'],
            ['name' => 'Klaim'],
            ['name' => 'Part Shop'],
            ['name' => 'Leasing'],
            ['name' => 'Lain-lain'],
        ]);
    }
}
