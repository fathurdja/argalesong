<?php

namespace App\Http\Controllers;

use App\Models\Piutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Sp_HarianController extends Controller
{
    public function index()
    {
        return view('schedulePiutang.Harian');
    }

    public function getDailyReport(Request $request)
    {
        $day = $request->input('day');
        $month = $request->input('month');
        $year = $request->input('year');

        // Avoid group by error in MySQL
        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        // Query to fetch the piutang data based on the selected year, month, and day
        $piutangData = DB::table('detailpiutang as x')
            ->leftJoin('vtbpiutang as y', 'x.no_invoice', '=', 'y.idpiutang')
            ->leftJoin('pembayaranpiutang as z', 'x.no_invoice', '=', 'z.no_invoice')
            ->leftJoin('customer as c', 'x.idpelanggan', '=', 'c.id_Pelanggan')
            ->select(
                'x.kodepiutang',
                'c.name as customer_name',
                'x.tgl_jatuh_tempo',
                'z.nominalbayar as total_pembayaran',
                'x.nominal as total_piutang',
                'y.xpiutang as saldo_piutang',
                DB::raw('CASE WHEN y.xpiutang <= 10 THEN 0 ELSE y.xpiutang END AS tagihan')
            )
            ->whereYear('x.tgltra', $year)
            ->whereMonth('x.tgltra', $month)
            ->whereDay('x.tgltra', $day)
            ->get();

        // Filter out items where tagihan (xpiutang) is 0
        $piutangData = $piutangData->filter(function ($item) {
            return $item->tagihan > 0; // Only keep items where tagihan is greater than 0
        });

        // If there is no data after filtering, return an empty response
        if ($piutangData->isEmpty()) {
            return response()->json([]);
        }

        // Organize data by customer (group by customer_name)
        $groupedData = $piutangData->groupBy('customer_name')->map(function ($group) {
            $firstItem = $group->first();
            return [
                'kodepiutang' => $firstItem->kodepiutang,
                'pelanggan' => $firstItem->customer_name,
                'jatuh_tempo' => $firstItem->tgl_jatuh_tempo,
                'total_piutang' => $group->sum('total_piutang'),
                'total_pembayaran' => $group->sum('total_pembayaran'),
                'saldo_piutang' => $group->sum('saldo_piutang'),
            ];
        });

        return response()->json($groupedData->values());
    }
// sp-harian detail mbul
    public function detail($id_pelanggan){
        $data = DB::table('detailpiutang as x')
        ->leftJoin('vtbpiutang as y', 'x.no_invoice', '=', 'y.idpiutang')
        ->leftJoin('pembayaranpiutang as z', 'x.no_invoice', '=', 'z.no_invoice')
        ->leftJoin('customer as c', 'x.idpelanggan', '=', 'c.id_Pelanggan')
        ->select(
            'x.kodepiutang',
            'c.name as customer_name',
            'x.tgl_jatuh_tempo',
            'z.nominalbayar as total_pembayaran',
            'x.nominal as total_piutang',
            'y.xpiutang as saldo_piutang')->first();
            
        return view('schedulePiutang.harian-detail', compact('data'));
    }
}
