<?php

namespace App\Http\Controllers;

use App\Models\masterDataPajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MasterDataPajakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = masterDataPajak::all();
        return view('masterData.masterData_pajak', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'new_tax_name' => 'required|string|max:255',
            'new_tax_value' => 'required|numeric',
            'new_tax_date' => 'required|date',
        ]);

        // Cek nilai pajakType terakhir di database
        $latestTax = masterDataPajak::orderBy('kode_pajak', 'desc')->first();

        // Tentukan nilai pajakType berikutnya
        if ($latestTax) {
            // Ambil angka dari pajakType terakhir dan tambahkan 1
            $lastNumber = (int)substr($latestTax->kode_pajak, 3); // Ambil angka setelah "PJK"
            $newPajakType = 'PJK' . ($lastNumber + 1);
        } else {
            // Jika tidak ada data, mulai dari "PJK1"
            $newPajakType = 'PJK1';
        }

        // Simpan data baru ke dalam tabel masterDataPajak
        masterDataPajak::create([
            'kode_pajak' => $newPajakType,
            'name' => $validatedData['new_tax_name'],
            'nilai' => $validatedData['new_tax_value'],
            'created_at' => $validatedData['new_tax_date'],
        ]);
  
        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('masterDataPajak.index')->with('success', 'Data pajak baru berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(masterDataPajak $masterDataPajak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(masterDataPajak $masterDataPajak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, masterDataPajak $masterDataPajak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari data pajak berdasarkan ID
        $pajak = masterDataPajak::findOrFail($id);

        // Hapus data pajak
        $pajak->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('masterDataPajak.index')->with('success', 'Data pajak berhasil dihapus.');
    }
}
