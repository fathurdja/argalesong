<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RekananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rekananData = [
            ['id_rekanan' => 101, 'name' => 'PT. Sukses Abadi', 'address' => 'Jl. Merdeka No. 123, Jakarta', 'phone' => '021-12345678', 'email' => 'contact@suksesabadi.com'],
            ['id_rekanan' => 102, 'name' => 'CV. Jaya Makmur', 'address' => 'Jl. Raya Bogor KM 5, Bogor', 'phone' => '0251-87654321', 'email' => 'info@jayamakmur.com'],
            ['id_rekanan' => 103, 'name' => 'PT. Maju Terus', 'address' => 'Jl. Diponegoro No. 45, Bandung', 'phone' => '022-98765432', 'email' => 'sales@majuterus.com'],
            ['id_rekanan' => 104, 'name' => 'CV. Karya Bersama', 'address' => 'Jl. Sudirman No. 67, Surabaya', 'phone' => '031-24681012', 'email' => 'support@karyabersama.com'],
            ['id_rekanan' => 105, 'name' => 'PT. Citra Gemilang', 'address' => 'Jl. Ahmad Yani No. 89, Semarang', 'phone' => '024-13579135', 'email' => 'admin@citragilang.com'],
        ];

        foreach ($rekananData as $data) {
            DB::table('rekanan')->insert([
                'id_rekanan' => $data['id_rekanan'],
                'name' => $data['name'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
