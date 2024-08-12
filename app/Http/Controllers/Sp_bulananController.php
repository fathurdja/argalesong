<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Sp_bulananController extends Controller
{
    public function index(){
        return view('schedulePiutang.Bulanan');
    }
}
