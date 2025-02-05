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
        $month = $request->input('month');
        $year = $request->input('year');

        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $piutangData = DB::table('detailpiutang as x')
            ->leftJoin('vtbpiutang as y', 'x.no_invoice', '=', 'y.idpiutang')
            ->leftJoin('pembayaranpiutang as z', 'x.no_invoice', '=', 'z.no_invoice')
            ->leftJoin('customer as c', 'x.idpelanggan', '=', 'c.id_Pelanggan')
            ->select(
                'x.id',
                'x.idpelanggan',
                'c.name as customer_name',
                'x.tgltra',
                'x.no_invoice',
                'x.tgl_jatuh_tempo',
                'x.jhari',
                'x.jenistagihan',
                'x.ppn',
                'x.pajak',
                'x.urutantagihan',
                'x.statusPembayaran',
                'x.jumlahTagihan',
                'x.kodepiutang',
                'x.nominal',
                'z.nominalbayar',
                'y.payment as bayar',
                'z.sisaPiutang',
                'y.xpiutang as tagihan',
                DB::raw('CASE WHEN y.xpiutang <= 10 THEN 0 ELSE y.xpiutang END AS tagihan')
            )
            ->whereYear('x.tgltra', $year)
            ->whereMonth('x.tgltra', $month)
            ->get();

        $piutangData = $piutangData->filter(function ($item) {
            return $item->tagihan > 0; // Only keep items where tagihan is greater than 0
        });
        $groupedData = $piutangData->groupBy('idpelanggan')->map(function ($group) {
            // Access properties using object notation
            $firstItem = $group->first();

            return [
                'id_pelanggan' => $firstItem->idpelanggan,
                'pelanggan' => $firstItem->customer_name,
                'jatuh_tempo' => $firstItem->tgl_jatuh_tempo,
                'tagihan' => $firstItem->tagihan, // Ambil tanggal jatuh tempo pertama (bisa disesuaikan)
                'total_piutang' => $group->sum('nominal'),
                'total_pembayaran' => $group->sum('bayar'),
                'saldo_piutang' => $group->sum('tagihan'),
            ];
        });

        return response()->json($groupedData->values());
    }
}
