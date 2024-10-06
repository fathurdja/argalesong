<?php

namespace App\Http\Controllers;

use App\Models\piutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class fetchdata extends Controller
{
    public function fetchInvoiceDetails(Request $request)
    {
        // Ambil nomor invoice dari query parameter
        $nomorInvoice = $request->query('nomor_invoice');
        Log::info("Fetching invoice details for: " . $nomorInvoice);

        // Mengambil detail piutang
        $piutang = piutang::getDetailPiutang($nomorInvoice);
        Log::info("Invoice details fetched: ", (array)$piutang);

        // Cek jika tidak ada piutang
        if (!$piutang) {
            return response()->json(['error' => 'Invoice not found'], 404);
        }

        // Kembalikan data dalam format JSON
        return response()->json([
            'nomor_invoice' => $piutang->no_invoice,
            'nama_pelanggan' => $piutang->pelanggan ? $piutang->pelanggan->name : null,
            'jatuh_tempo' => $piutang->tgl_jatuh_tempo,
            'piutang_belum_dibayar' => $piutang->nominal,
        ]);
    }
}
