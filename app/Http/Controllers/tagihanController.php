<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Rekanan;
use Illuminate\Http\Request;

class tagihanController extends Controller
{
    public function index()
    {
        return view('tagihanForm');
    }

    public function create()
    {
        $rekanans = Rekanan::all();
        return view('tagihanForm', compact('rekanans'));
    }

    public function getData(Request $request)
    {
        $data = Master::where('nomor_bukti', $request->nomor_bukti)->first();
        return response()->json($data);
    }
}
