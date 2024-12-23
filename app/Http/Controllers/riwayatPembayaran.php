<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class riwayatPembayaran extends Controller
{
    public function index()
    {
        $riwayatPembayaran = DB::table('vtb_riwayatpembayaran')->get();
        return view('pembayaran_piutang.riwayatPembayaran', compact('riwayatPembayaran'));
    }
}
