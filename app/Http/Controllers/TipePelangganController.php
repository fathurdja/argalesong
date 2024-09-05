<?php

namespace App\Http\Controllers;

use App\Models\tipePelanggan;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;

class TipePelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Fetch all types from the database
        // Assuming you're fetching from the database
        $tipePelanggan = tipePelanggan::all();

        // Check for a specific type (e.g., 'Afiliasi')
        $searchString = 'Afiliasi';

        $found = false;
        foreach ($tipePelanggan as $tipe) {
            if (stripos($tipe->name, $searchString) !== false) {
                $found = true;
                break;
            }
        }

        // Pass the data to the view
        $columns = [
            'Tipe Pelanggan' => $tipePelanggan->pluck('name')->toArray(),
            'Tipe Piutang' => ['Karyawan', 'Afiliasi', 'Sewa-menyewa', 'Sharing Revenue', 'Agen Travel', 'Padi Residence', 'Klaim', 'Part Shop', 'Leasing', 'Lain-lain', 'tambahkan baru'],
            'Jika Jatuh Tempo' => ['Denda', 'Blacklist'],
            'Jika Lewat Plafon' => ['Peringatan', 'Blacklist']
        ];

        // Return the view with the data
       
    }
    public function store(HttpRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tipe_pelanggans,name',
        ]);

        DB::beginTransaction();

        try {
            // Dapatkan ID terakhir
            $lastId = TipePelanggan::orderBy('id', 'desc')->first()->id ?? '000';

            // Increment ID
            $newId = str_pad((int)$lastId + 1, 3, '0', STR_PAD_LEFT);

            // Buat tipe pelanggan baru
            $tipePelanggan = new TipePelanggan();
            $tipePelanggan->id = $newId;
            $tipePelanggan->name = $request->name;
            $tipePelanggan->save();

            DB::commit();

            return response()->json([
                'message' => 'Tipe Pelanggan berhasil ditambahkan',
                'data' => $tipePelanggan
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Terjadi kesalahan saat menambahkan Tipe Pelanggan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
