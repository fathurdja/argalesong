<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kp_pelangganController extends Controller
{
    public function index()
    {
        return view('kartuPelanggan.pelanggan');
    }
}
