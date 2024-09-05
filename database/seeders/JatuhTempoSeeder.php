<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JatuhTempoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jatuh_tempos')->insert([
            ['name' => 'Denda'],
            ['name' => 'Blacklist'],
        ]);
    }
}
