<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class formeditDaftarController extends Controller
{
    public function index(){
        return view('daftarPelangggan.formedit');
    }
}
