<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pbSewaMenyewaController extends Controller
{
    public function index()
    {
        return view('piutangBaru.sewa-menyewa');
    }
}
