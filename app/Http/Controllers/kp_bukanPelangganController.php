<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kp_bukanPelangganController extends Controller
{
    public function index()
    {
        return view('kartuPelanggan.bukanPelanggan');
    }
}
