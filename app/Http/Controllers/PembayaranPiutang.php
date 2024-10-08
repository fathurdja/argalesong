<?php

namespace App\Http\Controllers;

use App\Models\piutang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PembayaranPiutang extends Controller
{
    public function showForm()
    {
        return view('Pembayaran_piutang.pembayaran');
    }


    public function proses(Request $request)
    {
        // Validasi inputan nomor invoice harus ada di database
        $validatedData = $request->validate([
            'invoices.*.nomor_invoice' => 'required|exists:detailpiutang,no_invoice',
        ]);

        $invoices = $request->input('invoices', []); // Ambil data invoice dari request
        $tanggalTransaksi = $request->input('tanggal_transaksi'); // Ambil tanggal transaksi
        $totalKeseluruhan = 0; // Inisialisasi total keseluruhan yang harus dibayar

        foreach ($invoices as $index => $invoice) {
            // Ambil detail piutang dari database
            $detailPiutang = piutang::with(['pelanggan', 'pajak', 'jenisPiutang'])
                ->where('no_invoice', $invoice['nomor_invoice'])
                ->first();

            if ($detailPiutang) {
                // Set data pelanggan, jatuh tempo, dan piutang belum dibayar
                $invoices[$index]['nama_pelanggan'] = $detailPiutang->pelanggan->name ?? '';
                $invoices[$index]['jatuh_tempo'] = $detailPiutang->tgl_jatuh_tempo;
                $invoices[$index]['piutang_belum_dibayar'] = $detailPiutang->nominal;

                // Hitung selisih hari antara tanggal transaksi dan jatuh tempo
                $jatuhTempo = Carbon::parse($detailPiutang->tgl_jatuh_tempo);
                $tanggalTransaksiCarbon = Carbon::parse($tanggalTransaksi);
                $selisihHari = $jatuhTempo->diffInDays($tanggalTransaksiCarbon, false); // Nilai negatif jika jatuh tempo belum tercapai

                // Hitung denda dan diskon
                $denda = 0;
                $diskon = 0;
                if ($selisihHari > 0) {
                    // Jika pembayaran melewati jatuh tempo
                    $denda = 0.01 * $selisihHari * $detailPiutang->nominal; // Misal 1% denda per hari
                    $invoices[$index]['denda'] = $denda;
                    $invoices[$index]['diskon'] = 0; // Tidak ada diskon
                } else {
                    // Jika pembayaran sebelum atau tepat jatuh tempo
                    $diskon = 0.01 * abs($selisihHari) * $detailPiutang->nominal; // Misal 1% diskon per hari
                    $invoices[$index]['diskon'] = $diskon;
                    $invoices[$index]['denda'] = 0; // Tidak ada denda
                }

                // Hitung total pembayaran untuk invoice ini
                $amountToPay = $detailPiutang->nominal - $diskon + $denda;
                $invoices[$index]['amount_to_pay'] = $amountToPay;

                // Tambahkan ke total keseluruhan
                $totalKeseluruhan += $amountToPay;
            }
        }

        // Kembalikan data invoices dan total keseluruhan ke view
        return back()->withInput(compact('invoices', 'totalKeseluruhan'));
    }
}
