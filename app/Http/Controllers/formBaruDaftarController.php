<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class formBaruDaftarController extends Controller
{
    public function index()
    {
        return view('daftarPelangggan.formBaru');
    }
}
