<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pp_baruController extends Controller
{
    public function index()
    {
        return view('pemutihanPiutang.baru');
    }
}
