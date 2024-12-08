<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $currentDate = Carbon::now()->translatedFormat('l, d M Y');
        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        // Query untuk mendapatkan data dari tabel `detailpiutang` dengan `leftJoin` ke `vtbpiutang`
        $query = DB::table('detailpiutang as x')
            ->leftJoin('vtbpiutang as y', 'x.no_invoice', '=', 'y.idpiutang')
            ->select(
                'x.tgl_jatuh_tempo',
                'y.xpiutang as tagihan' // Menggunakan kolom tagihan sebagai basis perhitungan
            );
        $data = $query->get();

        // Mengelompokkan data berdasarkan kategori umur piutang secara keseluruhan
        $summaryData = $this->calculateAgingSummary($data);
        // dd($summaryData);
        return view('home', compact('user', 'currentDate', 'summaryData'));
    }
    private function calculateAgingSummary($data)
    {
        $result = [
            '< 30 hari' => 0,
            '> 30 hari' => 0,
            '> 60 hari' => 0,
            '> 90 hari' => 0,
        ];

        $today = Carbon::now();

        foreach ($data as $item) {
            $dueDate = Carbon::parse($item->tgl_jatuh_tempo);
            $daysPastDue = $today->diffInDays($dueDate, false); // false agar negatif jika lewat jatuh tempo

            // Tentukan kategori umur piutang dan tambahkan ke total kategori yang sesuai
            if ($daysPastDue <= 30 && $daysPastDue >= 0) {
                $result['< 30 hari'] += $item->tagihan;
            } elseif ($daysPastDue > 30 && $daysPastDue <= 60) {
                $result['> 30 hari'] += $item->tagihan;
            } elseif ($daysPastDue > 60 && $daysPastDue <= 90) {
                $result['> 60 hari'] += $item->tagihan;
            } elseif ($daysPastDue > 90) {
                $result['> 90 hari'] += $item->tagihan;
            }
        }

        // Mengubah data menjadi format yang dapat digunakan dalam tabel
        $summaryTable = [];
        $no = 1;
        foreach ($result as $aging => $total) {
            $summaryTable[] = [
                'no' => $no++,
                'aging' => $aging,
                'total' => $total,
            ];
        }

        return $summaryTable;
    }
}
