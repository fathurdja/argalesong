<?php

namespace App\Http\Controllers;

use App\Models\piutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JatuhTempoController extends Controller
{
    public function index()
    {
        $customers = piutang::all();
        return view('jatuhTempo.jatuhTempo', ['customers' => $customers]);
    }

    public function getJatuhTempo($year, $month)
    {
        $jatuhTempo = DB::table('detailpiutang')
            ->whereYear('tgl_jatuh_tempo', $year)
            ->whereMonth('tgl_jatuh_tempo', $month)
            ->get();

        return response()->json($jatuhTempo);
    }

    // mbul detail jatuh tempo
    public function detail($no_invoice){
        $pelanggan = piutang::where('no_invoice', $no_invoice)->first();
        return view('jatuhTempo.jatuh-tempo-detail', compact('pelanggan'));
    }
}
