<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pp_pengajuan extends Controller
{
    public function index()
    {
        return view('pemutihanPiutang.pengajuan');
    }
    public function detail()
    {
        return view('pemutihanPiutang.detailPengajuan');
    }
}
