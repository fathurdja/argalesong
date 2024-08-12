<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Sp_HarianController extends Controller
{
    public function index()
    {
        return view('schedulePiutang.Harian');
    }
}
