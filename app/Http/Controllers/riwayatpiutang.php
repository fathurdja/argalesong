<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class riwayatpiutang extends Controller
{
    public function index()
    {
        $piutang = DB::select("
        SELECT 
            x.id, 
            x.idpelanggan, 
            c.name AS customer_name, -- Mengambil nama customer
            t.name AS tipe_pelanggan, -- Mengambil nama tipe pelanggan
            x.tgltra, 
            x.no_invoice, 
            x.tgl_jatuh_tempo, 
            x.jhari, 
            x.jenistagihan, 
            x.ppn, 
            x.pph, 
            x.urutantagihan, 
            x.statusPembayaran, 
            x.jumlahTagihan, 
            x.kodepiutang, 
            m.name AS tipepiutang, -- Mengambil tipe piutang
            x.dpp,
            x.nominal,
            y.xpiutang AS tagihan
        FROM detailpiutang x
        LEFT JOIN vtbpiutang y 
            ON x.no_invoice = y.idpiutang
        LEFT JOIN customer c 
            ON x.idpelanggan = c.id_Pelanggan -- Join dengan tabel customer
        LEFT JOIN tipepiutang m 
            ON x.kodepiutang = m.kodePiutang -- Join dengan tabel masterpiutang
        LEFT JOIN tipepelanggan t 
            ON c.idtypepelanggan = t.kodeType -- Join dengan tabel tipepelanggan
        ORDER BY x.tgltra DESC
    ");


        // Mengirim data ke view
        return view('piutangBaru.riwayatpiutang', compact('piutang'));
    }
}
