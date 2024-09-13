<?php

namespace App\Http\Controllers;

use App\Models\piutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Sp_bulananController extends Controller
{
    public function index()
    {
        return view('schedulePiutang.Bulanan');
    }

    public function getMonthlyReport(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');

        // Query untuk mendapatkan data piutang berdasarkan tahun dan bulan
        $data = piutang::with('pelanggan')
            ->whereYear('tgltra', $year)
            ->whereMonth('tgltra', $month)
            ->get();


 
        // Kembalikan response JSON ke view
        return response()->json($data);
    }
}
