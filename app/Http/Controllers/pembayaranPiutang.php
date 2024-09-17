<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pembayaranPiutang extends Controller
{
    public function index()
    {
        return view('pembayaran_piutang.pembayaran');
    }
}
