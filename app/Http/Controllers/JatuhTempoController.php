<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JatuhTempoController extends Controller
{
    public function index(){
        return view('jatuhTempo.jatuhTempo');
    }
}
