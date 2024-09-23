<?php

namespace App\Http\Controllers;

use App\Models\piutang;
use Illuminate\Http\Request;

class PembayaranPiutangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Check if an invoice number is provided
        if ($request->has('nomor_invoice')) {
            $invoice = $request->input('nomor_invoice');

            // Fetch the detail piutang record based on the invoice number (idtrx)
            $detailPiutang = Piutang::where('idtra', $invoice)->first();

            if ($detailPiutang) {
                // Fetch related customer and tipe pelanggan data
                $customer = $detailPiutang->pelanggan; // Relation defined in DetailPiutang model
                $tipePelanggan = $customer->tipePelanggan; // Relation defined in Customer model
                $jenisPiutang = $detailPiutang->jenisPiutang;

                // Pass the retrieved data to the view
                return view('pembayaran_piutang.pembayaran', [
                    'pelanggan' => $customer,
                    'tipePelanggan' => $tipePelanggan,
                    'detailPiutang' => $detailPiutang,
                    'jenisPiutang' => $jenisPiutang
                ]);
            } else {
                return back()->withErrors('Invoice not found.');
            }
        }

        // Default view if no invoice is entered
        return view('pembayaran_piutang.pembayaran');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getPelangganByInvoice(Request $request)
    {
        // Validasi input

    }
}
