<?php

namespace App\Http\Controllers;

use App\Models\masterCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class riwayatPembayaran extends Controller
{
    // public function index(Request $request)
    // {
    //     $filterCompany = $request->input('idcompany');
    //     DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
    //     $riwayatPembayaran = DB::table('vtb_riwayatpembayaran')
    //         ->when($filterCompany, function ($query, $filterGroup) {
    //             return $query->where('Perusahaan', '=', $filterGroup);
    //         })
    //         ->paginate(10);
    //     $perusahaan = masterCompany::all();

    //     // Ambil filter perusahaan dari request
    //     return view('pembayaran_piutang.riwayatPembayaran', compact('riwayatPembayaran', 'perusahaan', 'filterCompany'));
    // }
    // mbul buat pencarian
    public function index(Request $request)
    {
        $filterCompany = $request->input('idcompany');
        $searchKeyword = $request->input('search');

        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $riwayatPembayaran = DB::table('vtb_riwayatpembayaran')
            ->when($filterCompany, function ($query, $filterCompany) {
                return $query->where('Perusahaan', '=', $filterCompany);
            })
            ->when($searchKeyword, function ($query, $searchKeyword) {
                return $query->where('NamaPelanggan', 'LIKE', "%$searchKeyword%");
            })
            // ->paginate(10);
            ->get();

        $perusahaan = masterCompany::all();

        return view('pembayaran_piutang.riwayatPembayaran', compact('riwayatPembayaran', 'perusahaan', 'filterCompany', 'searchKeyword'));
    }

    // mbul buat untuk detail pembayaran
    public function detail($IDPembayaran)
    {
        $results = DB::table('vtb_riwayatpembayaran')
            ->leftJoin('pembayaranpiutang as p', 'vtb_riwayatpembayaran.IDPembayaran', '=', 'p.idtrx')
            ->where('vtb_riwayatpembayaran.IDPembayaran', $IDPembayaran)
            ->select(
                'vtb_riwayatpembayaran.*',
                'p.no_invoice',
                'p.tagihan',
                'p.tglbayar',
            )
            ->get();

        // dd($results);
        // Inisialisasi array untuk hasil grouping
        $grouped = [];

        // Looping setiap data hasil query
        foreach ($results as $row) {
            $idPembayaran = $row->IDPembayaran;

            // Jika key IDPembayaran belum ada, inisialisasi data utama dan array invoice
            if (!isset($grouped[$idPembayaran])) {
                $grouped[$idPembayaran] = [
                    'detail'  => [
                        'IDPembayaran'      => $row->IDPembayaran,
                        'NamaPelanggan'     => $row->NamaPelanggan,
                        'Perusahaan'        => $row->Perusahaan,
                        'ModePembayaran'    => $row->ModePembayaran,
                        'TotalSemuaPiutang' => $row->TotalSemuaPiutang,
                        'NominalyangDibayar' => $row->NominalyangDibayar,
                        'Sisa'              => $row->Sisa,
                        'tglbayar'          => $row->tglbayar,
                        // tambahkan field lain sesuai kebutuhan
                    ],
                    'invoices' => [] // inisialisasi array invoice
                ];
            }

            // Jika data invoice tersedia (misalnya no_invoice tidak null)
            if ($row->no_invoice) {
                $grouped[$idPembayaran]['invoices'][] = [
                    'no_invoice' => $row->no_invoice,
                    'tagihan'    => $row->tagihan,
                    // tambahkan field invoice lain jika diperlukan
                ];
            }
        }

        // Jika hanya ingin menampilkan data untuk IDPembayaran tertentu (sebagai array indexed numerik)
        $detail = array_values($grouped);

        return view('pembayaran_piutang.riwayatPembayaranDetail', compact('detail'));
    }
}
