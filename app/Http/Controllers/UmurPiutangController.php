<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UmurPiutangController extends Controller
{
    public function index()
    {
        return view('umurPiutang.umurPiutang');
    }
}
