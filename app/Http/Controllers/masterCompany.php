<?php

namespace App\Http\Controllers;

use App\Models\masterCompany as ModelsMasterCompany;
use Illuminate\Support\Facades\Http;

class masterCompany extends Controller
{
    public function fetchAndStoreCompanies()
    {
        try {
            // Ambil data dari API
            $response = Http::get('https://api.galesong.co.id/master/company'); // Ganti dengan URL API Anda

            // Periksa apakah request berhasil
            if ($response->successful()) {
                $data = $response->json(); // Mengambil data JSON dari response

                if ($data['status'] === 'success') {
                    $companies = $data['data']; // Ambil data perusahaan

                    foreach ($companies as $company) {
                        // Periksa apakah company_id sudah ada di database
                        $existingCompany = ModelsMasterCompany::where('company_id', $company['company_id'])->first();

                        if (!$existingCompany) {
                            // Simpan data ke database jika belum ada
                            ModelsMasterCompany::create([
                                'company_id' => $company['company_id'],
                                'code'       => $company['code'],
                                'name'       => $company['name'],
                                'business'   => $company['business'],
                                'image'      => $company['image'],
                                'created_at' => $company['create_at'],
                                'updated_at' => now(), // Set waktu saat ini sebagai updated_at
                            ]);
                        } else {
                            // Jika data sudah ada, update data yang berubah
                            $existingCompany->update([
                                'code'     => $company['code'],
                                'name'     => $company['name'],
                                'business' => $company['business'],
                                'image'    => $company['image'],
                                'updated_at' => now(),
                            ]);
                        }
                    }

                    return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan atau diperbarui.']);
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan di API.']);
                }
            } else {
                return response()->json(['status' => 'error', 'message' => 'Gagal mengakses API.']);
            }
        } catch (\Exception $e) {
            // Tangani error jika terjadi kesalahan
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
