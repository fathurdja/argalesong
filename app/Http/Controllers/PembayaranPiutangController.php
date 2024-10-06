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
        $pelanggan = null;

        // If the form has been submitted and nomor_invoice is present
        if ($request->has('nomor_invoice')) {
            // Fetch the Piutang data based on the invoice numbers
            $pelanggan = Piutang::whereIn('no_invoice', $request->nomor_invoice)->get();
        }

        // Pass the Piutang data to the view
        return view('pembayaran_piutang.pembayaran', compact('pelanggan'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $data = $request->all();

    //     // Loop through each invoice number provided in the request
    //     foreach ($data['nomor_invoice'] as $index => $nomorInvoice) {
    //         // Fetch the Piutang record based on the invoice number
    //         $piutang = Piutang::where('no_invoice', $nomorInvoice)->first();

    //         // If Piutang data is found, process it
    //         if ($piutang) {
    //             $namaPelanggan = $data['nama_pelanggan'][$index]; // From the request
    //             $jatuhTempo = $piutang->jatuh_tempo; // From Piutang model
    //             $piutangBelumDibayar = $piutang->piutang_belum_dibayar; // From Piutang model
    //             $denda = $data['denda'][$index]; // From the request
    //             $diskon = $data['diskon'][$index]; // From the request

    //             // Example of saving payment details or performing your desired operations
    //             // Pembayaran::create([
    //             //     'nomor_invoice' => $nomorInvoice,
    //             //     'nama_pelanggan' => $namaPelanggan,
    //             //     'jatuh_tempo' => $jatuhTempo,
    //             //     'piutang_belum_dibayar' => $piutangBelumDibayar,
    //             //     'denda' => $denda,
    //             //     'diskon' => $diskon,
    //             //     // Other fields as necessary
    //             // ]);

    //             // You can also update the Piutang record if necessary
    //             $piutang->update([
    //                 'piutang_belum_dibayar' => $piutangBelumDibayar - ($data['nominal_bayar'][$index] ?? 0),
    //             ]);
    //         } else {
    //             // Handle case where no Piutang record is found for the given invoice number
    //             return redirect()->back()->withErrors("No piutang found for invoice number $nomorInvoice.");
    //         }
    //     }

    //     // Redirect or return a success response
    //     return redirect()->route('pembayaran-piutang.index')->with('success', 'Payments processed successfully!');
    // }




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

   
}
