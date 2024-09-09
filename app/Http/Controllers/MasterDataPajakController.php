<?php

namespace App\Http\Controllers;

use App\Models\masterDataPajak;
use Illuminate\Http\Request;

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
        $validatedData = $request->validate([
            'new_tax_name' => 'required|string|max:255',
            'new_tax_value' => 'required|numeric',
            'new_tax_date' => 'required|date',
        ]);

        masterDataPajak::create([
            'name' => $validatedData['new_tax_name'],
            'nilai' => $validatedData['new_tax_value'],
            'created_at' => $validatedData['new_tax_date'],
        ]);

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
    public function destroy(masterDataPajak $masterDataPajak)
    {
        //
    }
}
