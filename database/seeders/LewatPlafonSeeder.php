<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LewatPlafonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lewat_plafons')->insert([
            ['name' => 'Peringatan'],
            ['name' => 'Blacklist'],
        ]);
    }
}
