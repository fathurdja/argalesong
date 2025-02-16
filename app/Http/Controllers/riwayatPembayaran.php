<?php

namespace App\Http\Controllers;

use App\Models\masterCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class riwayatPembayaran extends Controller
{
    public function index(Request $request)
    {
        $filterCompany = $request->input('idcompany');
        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
        $riwayatPembayaran = DB::table('vtb_riwayatpembayaran')
            ->when($filterCompany, function ($query, $filterGroup) {
                return $query->where('Perusahaan', '=', $filterGroup);
            })
            ->paginate(10);




        $perusahaan = masterCompany::all();

        // Ambil filter perusahaan dari request


        return view('pembayaran_piutang.riwayatPembayaran', compact('riwayatPembayaran', 'perusahaan', 'filterCompany'));
    }

    // mbul buat untuk detail pembayaran
    public function detail($IDPembayaran){
        $detail = DB::table('vtb_riwayatpembayaran')->where('IDPembayaran', $IDPembayaran)->first();
        return view('pembayaran_piutang.riwayatPembayaranDetail', compact('detail'));
    }
}
