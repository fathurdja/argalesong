<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UmurPiutangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Setting SQL mode untuk menghindari masalah mode ONLY_FULL_GROUP_BY
        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        // Query untuk mendapatkan data dari tabel `detailpiutang` dengan `leftJoin` ke `vtbpiutang`
        $query = DB::table('detailpiutang as x')
            ->leftJoin('vtbpiutang as y', 'x.no_invoice', '=', 'y.idpiutang')
            ->leftJoin('customer', 'x.idpelanggan', '=', 'customer.id_Pelanggan') // Join dengan tabel customer untuk nama pelanggan
            ->select(
                'x.id',
                'x.idpelanggan',
                'customer.name as customer_name', // Nama pelanggan
                'x.tgltra',
                'x.no_invoice',
                'x.tgl_jatuh_tempo',
                'y.xpiutang as tagihan' // Menggunakan kolom tagihan sebagai basis perhitungan
            );

        // Filter data berdasarkan pencarian (ID atau Nama Perusahaan) jika ada input pencarian
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('customer.name', 'LIKE', "%{$search}%")  // Filter berdasarkan nama perusahaan
                    ->orWhere('customer.id_Pelanggan', 'LIKE', "%{$search}%"); // Filter berdasarkan ID pelanggan
            });
        }

        $data = $query->get();
        // dd($data);
        // Mengelompokkan data berdasarkan nama pelanggan dan kategori umur piutang
        $grouped_data = $this->groupDataByAging($data);
        // dd($grouped_data);
        // Menghitung ringkasan total berdasarkan kategori umur piutang
        $totalsByCategory = $this->calculateSummaryTotals($grouped_data);
        // dd($totalsByCategory);
        // Kirim data ke view
        return view('umurPiutang.umurPiutang', compact('grouped_data', 'totalsByCategory', 'search'));
    }

    /**
     * Mengelompokkan data berdasarkan kategori umur piutang.
     */
    private function groupDataByAging($data)
    {
        $result = [];
        $today = Carbon::now();

        foreach ($data as $item) {
            $customerName = $item->customer_name;
            $customerId = $item->idpelanggan; // Tambahkan ID pelanggan
            $dueDate = Carbon::parse($item->tgl_jatuh_tempo);
            $daysPastDue = $today->diffInDays($dueDate, false); // false agar negatif jika lewat jatuh tempo

            // Tentukan kategori umur piutang
            if ($daysPastDue <= 30) {
                $category = '< 30 days';
            } elseif ($daysPastDue > 30 && $daysPastDue <= 60) {
                $category = '> 30 days';
            } elseif ($daysPastDue > 60 && $daysPastDue <= 90) {
                $category = '> 60 days';
            } elseif ($daysPastDue > 90 && $daysPastDue <= 120) {
                $category = '> 90 days';
            } else {
                $category = '> 120 days';
            }

            // Jika pelanggan belum ada di hasil, tambahkan array baru untuknya
            if (!isset($result[$customerId])) {
                $result[$customerId] = [
                    'customer_name' => $customerName,
                    '< 30 days' => 0,
                    '> 30 days' => 0,
                    '> 60 days' => 0,
                    '> 90 days' => 0,
                    '> 120 days' => 0,
                    'total' => 0,
                ];
            }

            // Tambahkan nilai tagihan ke kategori yang sesuai
            $result[$customerId][$category] += $item->tagihan;
            $result[$customerId]['total'] += $item->tagihan;
        }

        return $result;
    }


    /**
     * Menghitung total piutang berdasarkan kategori umur.
     */
    private function calculateSummaryTotals($grouped_data)
    {
        $totals = [
            '< 30 days' => 0,
            '> 30 days' => 0,
            '> 60 days' => 0,
            '> 90 days' => 0,
            '> 120 days' => 0,
            'total' => 0,
        ];

        foreach ($grouped_data as $customerData) {
            $totals['< 30 days'] += $customerData['< 30 days'];
            $totals['> 30 days'] += $customerData['> 30 days'];
            $totals['> 60 days'] += $customerData['> 60 days'];
            $totals['> 90 days'] += $customerData['> 90 days'];
            $totals['> 120 days'] += $customerData['> 120 days'];
            $totals['total'] += $customerData['total'];
        }

        return $totals;
    }
}
