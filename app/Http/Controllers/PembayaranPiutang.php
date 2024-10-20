<?php

namespace App\Http\Controllers;

use App\Models\piutang;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranPiutang extends Controller
{
    public function showForm()
    {
        return view('pembayaran_piutang.pembayaran');
    }


    public function proses(Request $request)
    {
        // Validasi inputan nomor invoice harus ada di database
        $validatedData = $request->validate([
            'invoices.*.nomor_invoice' => 'required|exists:detailpiutang,no_invoice',
        ]);

        $invoices = $request->input('invoices', []); // Ambil data invoice dari request
        $tanggalTransaksi = $request->input('tanggal_transaksi'); // Ambil tanggal transaksi
        $totalKeseluruhan = 0; // Inisialisasi total keseluruhan yang harus dibayar

        foreach ($invoices as $index => $invoice) {
            // Ambil detail piutang dari database
            $detailPiutang = piutang::with(['pelanggan', 'pajak', 'jenisPiutang'])
                ->where('no_invoice', $invoice['nomor_invoice'])
                ->first();

            if ($detailPiutang) {
                $nominal = (float) $detailPiutang->nominal;
                // Set data pelanggan, jatuh tempo, dan piutang belum dibayar
                $invoices[$index]['nama_pelanggan'] = $detailPiutang->pelanggan->name ?? '';
                $invoices[$index]['idpelanggan'] = $detailPiutang->idpelanggan ?? '';
                $invoices[$index]['jatuh_tempo'] = $detailPiutang->tgl_jatuh_tempo;
                $invoices[$index]['piutang_belum_dibayar'] = $nominal;

                // Hitung selisih hari antara tanggal transaksi dan jatuh tempo
                $jatuhTempo = Carbon::parse($detailPiutang->tgl_jatuh_tempo);
                $tanggalTransaksiCarbon = Carbon::parse($tanggalTransaksi);
                $selisihHari = $jatuhTempo->diffInDays($tanggalTransaksiCarbon, false); // Nilai negatif jika jatuh tempo belum tercapai

                // Hitung denda dan diskon
                $denda = 0;
                $diskon = 0;
                if ($selisihHari > 0) {
                    // Jika pembayaran melewati jatuh tempo
                    $denda = 0.01 * $selisihHari * $detailPiutang->nominal; // Misal 1% denda per hari
                    $invoices[$index]['denda'] = $denda;
                    $invoices[$index]['diskon'] = 0; // Tidak ada diskon
                } else {
                    // Jika pembayaran sebelum atau tepat jatuh tempo
                    $diskon = 0.01 * abs($selisihHari) * $detailPiutang->nominal; // Misal 1% diskon per hari
                    $invoices[$index]['diskon'] = $diskon;
                    $invoices[$index]['denda'] = 0; // Tidak ada denda
                }

                // Hitung total pembayaran untuk invoice ini
                $amountToPay = $detailPiutang->nominal - $diskon + $denda;
                $invoices[$index]['amount_to_pay'] = $amountToPay;

                // Tambahkan ke total keseluruhan
                $totalKeseluruhan += $amountToPay;
            }
        }

        // Kembalikan data invoices dan total keseluruhan ke view
        return back()->withInput(compact('invoices', 'totalKeseluruhan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_transaksi' => 'required|date',
            'invoices' => 'required|array',
            'invoices.*.nomor_invoice' => 'required|string',
            'nominal_dibayar' => 'required|numeric|min:0',
            'invoices.*.idpelanggan' => 'required|string',
            'invoices.*.diskon' => 'nullable|numeric|min:0',
            'invoices.*.denda' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable|string',
            'mode_bayar' => 'required|in:KAS,BANK'
        ]);

        DB::beginTransaction();
        try {
            $totalNominalDibayar = $request->nominal_dibayar;
            $idTransaksi = $this->generateTransactionId();
            $totalNominalDibayar = floatval($request->nominal_dibayar);
            $diskon = floatval($request->diskon ?? 0); // Jika diskon null, jadikan 0
            $denda = floatval($request->denda ?? 0); // Jika denda null, jadikan 0
            foreach ($request->invoices as $pembayaran) {
                $diskon = floatval($pembayaran['diskon'] ?? 0);
                $denda = floatval($pembayaran['denda'] ?? 0);
                $detailPiutangs = DB::select('SELECT *, idpelanggan,nominal FROM detailpiutang WHERE no_invoice = ? ORDER BY urutanTagihan', [$pembayaran['nomor_invoice']]);
                foreach ($detailPiutangs as $detailPiutang) {
                    if ($totalNominalDibayar <= 0) break;
                    $pembayaranSebelumnya = DB::scalar('SELECT COALESCE(SUM(nominalbayar), 0) FROM pembayaranpiutang WHERE no_invoice = ?', [$detailPiutang->no_invoice]);
                    $piutangAwal = $detailPiutang->nominal - $pembayaranSebelumnya;
                    if ($totalNominalDibayar >= $piutangAwal) {
                        $pembayaranNow = $piutangAwal;
                        $status = 'LUNAS';
                    } else {
                        $pembayaranNow = $totalNominalDibayar;
                        $status = 'SEBAGIAN';
                    }
                    $idpelanggan = $detailPiutang->idpelanggan;
                    $formattedPembayaranNow = number_format($pembayaranNow, 1, '.', ',');

                    $sisa =  $piutangAwal - $pembayaranNow;
                    $sisaPiutang = floatval($sisa);
                    $tagihan = $detailPiutang->nominal;
                    DB::insert('INSERT INTO pembayaranpiutang (idpelanggan,idtrx, tglbayar, no_invoice, nominalbayar, tagihan,sisaPiutang,diskon,denda,modebayar) VALUES (?,?,?, ?, ?, ?, ?, ?,?,?)', [
                        $idpelanggan,
                        $idTransaksi,

                        $request->tanggal_transaksi,
                        $detailPiutang->no_invoice,
                        $tagihan,
                        $pembayaranNow,
                        $sisaPiutang,
                        $diskon,
                        $denda,
                        $request->mode_bayar
                    ]);
                    DB::update('UPDATE detailpiutang SET statusPembayaran = ? WHERE no_invoice = ?', [$status, $detailPiutang->no_invoice]);
                    $totalNominalDibayar -= $pembayaranNow;
                }
            }
            DB::commit();
            Alert::success('Berhasil!', 'Piutang Berhasil di Bayar');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
    private function generateTransactionId()
    {
        $lastId = DB::table('pembayaranpiutang')
            ->select('idtrx')
            ->orderByRaw('CAST(SUBSTRING(idtrx, 5) AS UNSIGNED) DESC')
            ->value('idtrx');

        if ($lastId) {
            $number = intval(substr($lastId, 4)) + 1;
        } else {
            $number = 1;
        }

        return 'TRX-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}
