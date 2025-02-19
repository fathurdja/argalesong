<?php

namespace App\Http\Controllers;

use App\Models\masterCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class riwayatpiutang extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua perusahaan untuk dropdown
        $perusahaan = masterCompany::all();

        // Ambil filter perusahaan dari request
        $filterCompany = $request->input('idcompany');

        // Query data piutang dengan pagination
        $query = DB::table('detailpiutang as x')
            ->leftJoin('vtbpiutang as y', 'x.no_invoice', '=', 'y.idpiutang')
            ->leftJoin('customer as c', 'x.idpelanggan', '=', 'c.id_Pelanggan')
            ->leftJoin('tipepiutang as m', 'x.kodepiutang', '=', 'm.kodePiutang')
            ->leftJoin('tipepelanggan as t', 'c.idtypepelanggan', '=', 't.kodeType')
            ->select(
                'x.id',
                'x.idpelanggan',
                'c.name as customer_name',
                't.name as tipe_pelanggan',
                'x.tgltra',
                'x.no_invoice',
                'x.tgl_jatuh_tempo',
                'x.jhari',
                'x.jenistagihan',
                'x.ppn',
                'x.pph',
                'x.urutantagihan',
            'x.statusPembayaran',
                'x.jumlahTagihan',
                'x.kodepiutang',
                'm.name as tipepiutang',
                'x.dpp',
		'x.created_by',
                'x.nominal',
                'c.idcompany',
                'y.xpiutang as tagihan'
            )
            ->orderBy('x.tgltra', 'DESC');

        // Tambahkan filter berdasarkan perusahaan jika ada
        if (!empty($filterCompany)) {
            $query->where('c.idcompany', '=', $filterCompany);
        }

        // Paginate hasil query (10 data per halaman)
        $piutang = $query->paginate(10);

        // Mengirim data ke view
        return view('piutangBaru.riwayatpiutang', compact('piutang', 'perusahaan', 'filterCompany'));
    }

    // public function print_ta

    // Dhimas buat detail riwayat piutang
    public function detail($noInvoice) {
        $detail = DB::table('detailpiutang as x')
            ->leftJoin('vtbpiutang as y', 'x.no_invoice', '=', 'y.idpiutang')
            ->leftJoin('customer as c', 'x.idpelanggan', '=', 'c.id_Pelanggan')
            ->leftJoin('tipepiutang as m', 'x.kodepiutang', '=', 'm.kodePiutang')
            ->leftJoin('tipepelanggan as t', 'c.idtypepelanggan', '=', 't.kodeType')
            ->select(
                'x.id',
                'x.idpelanggan',
                'c.name as customer_name',
                't.name as tipe_pelanggan',
                'x.tgltra',
                'x.no_invoice',
                'x.tgl_jatuh_tempo',
                'x.jhari',
                'x.jenistagihan',
                'x.ppn',
                'x.pph',
                'x.urutantagihan',
            'x.statusPembayaran',
                'x.jumlahTagihan',
                'x.kodepiutang',
                'm.name as tipepiutang',
                'x.dpp',    
		'x.created_by',
                'x.nominal',
                'c.idcompany',
                'y.xpiutang as tagihan'
            )->where('x.no_invoice', $noInvoice)->first();
        return view('piutangBaru.detailriwayatpiutang', compact('detail'));
    } 
}
