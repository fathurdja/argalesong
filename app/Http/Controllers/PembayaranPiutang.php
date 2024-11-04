<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\piutang;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranPiutang extends Controller
{
    public function showForm(Request $request)
    {
        // Mendapatkan pelanggan yang terpilih (jika ada)
        $selectedCustomerId = $request->input('nama_pelanggan');

        // Mengambil semua pelanggan untuk ditampilkan di select option
        $customers = Customer::all();

        // Jika pelanggan dipilih, ambil piutang yang terkait
        $invoices = collect();  // inisialisasi collection kosong
        if ($selectedCustomerId) {
            $invoices = Piutang::where('idpelanggan', $selectedCustomerId)
                ->where('statusPembayaran', '!=', 'LUNAS')
                ->get();
        }

        // Menggunakan method sum() pada collection untuk menjumlahkan field nominal
        $totalKeseluruhan = $invoices->sum('nominal');  // Piutang keseluruhan

        return view('pembayaran_piutang.pembayaran', compact('customers', 'invoices', 'totalKeseluruhan', 'selectedCustomerId'));
    }


    public function proses(Request $request)
    {
        // Validasi inputan nama pelanggan harus ada di database
        $validatedData = $request->validate([
            'invoices.*.nama_pelanggan' => 'required|exists:pelanggan,name',
        ]);

        $invoices = $request->input('invoices', []); // Ambil data invoice dari request
        $tanggalTransaksi = $request->input('tanggal_transaksi'); // Ambil tanggal transaksi
        $totalKeseluruhan = 0; // Inisialisasi total keseluruhan yang harus dibayar

        foreach ($invoices as $index => $invoice) {
            // Ambil detail piutang dari database berdasarkan nama pelanggan
            $detailPiutang = piutang::with(['pelanggan', 'pajak', 'jenisPiutang'])
                ->whereHas('pelanggan', function ($query) use ($invoice) {
                    $query->where('name', $invoice['nama_pelanggan']);
                })
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
    // Reindex array invoices sebelum validasi
    if ($request->has('invoices')) {
        $invoices = array_values($request->invoices);
        $request->merge(['invoices' => $invoices]);
    }

    // Validasi dasar tanpa validasi array
    $request->validate([
        'tanggal_transaksi' => 'required|date',
        'nominal_dibayar' => 'required|numeric|min:0',
        'customer' => 'required|string',
        'mode_bayar' => 'required|in:KAS,BANK',
        'keterangan' => 'nullable|string',
    ]);

    // Validasi custom untuk invoices
    if (!$request->has('invoices') || empty($request->invoices)) {
        return back()->withErrors(['error' => 'Minimal satu invoice harus dipilih.']);
    }

    DB::beginTransaction();
    try {
        $totalNominalDibayar = floatval($request->nominal_dibayar);
        $idTransaksi = $this->generateTransactionId();

        foreach ($request->invoices as $pembayaran) {
            // Validasi setiap invoice
            if (empty($pembayaran['nomor_invoice'])) {
                continue; // Skip jika nomor invoice kosong
            }

            $diskon = floatval($pembayaran['diskon'] ?? 0);
            $denda = floatval($pembayaran['denda'] ?? 0);
            
            $detailPiutangs = DB::select(
                'SELECT *, idpelanggan, nominal FROM detailpiutang 
                WHERE no_invoice = ? ORDER BY urutanTagihan',
                [$pembayaran['nomor_invoice']]
            );

            if (empty($detailPiutangs)) {
                throw new \Exception("Invoice {$pembayaran['nomor_invoice']} tidak ditemukan.");
            }

            foreach ($detailPiutangs as $detailPiutang) {
                if ($totalNominalDibayar <= 0) break;

                $pembayaranSebelumnya = DB::scalar(
                    'SELECT COALESCE(SUM(nominalbayar), 0) 
                    FROM pembayaranpiutang 
                    WHERE no_invoice = ?',
                    [$detailPiutang->no_invoice]
                );

                $piutangAwal = $detailPiutang->nominal - $pembayaranSebelumnya;
                
                if ($totalNominalDibayar >= $piutangAwal) {
                    $pembayaranNow = $piutangAwal;
                    $status = 'LUNAS';
                } else {
                    $pembayaranNow = $totalNominalDibayar;
                    $status = 'SEBAGIAN';
                }

                $sisa = $piutangAwal - $pembayaranNow;
                $sisaPiutang = floatval($sisa);
                $tagihan = $detailPiutang->nominal;

                DB::insert(
                    'INSERT INTO pembayaranpiutang 
                    (idpelanggan, idtrx, tglbayar, no_invoice, nominalbayar, 
                    tagihan, sisaPiutang, diskon, denda, modebayar) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                    [
                        $detailPiutang->idpelanggan,
                        $idTransaksi,
                        $request->tanggal_transaksi,
                        $detailPiutang->no_invoice,
                        $tagihan,
                        $pembayaranNow,
                        $sisaPiutang,
                        $diskon,
                        $denda,
                        $request->mode_bayar
                    ]
                );

                DB::update(
                    'UPDATE detailpiutang 
                    SET statusPembayaran = ? 
                    WHERE no_invoice = ?',
                    [$status, $detailPiutang->no_invoice]
                );

                $totalNominalDibayar -= $pembayaranNow;
            }
        }

        DB::commit();
        Alert::success('Berhasil!', 'Piutang Berhasil di Bayar');
        return redirect()->back();

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
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

    public function getInvoicesByCustomer($customerId)
    {
        $invoices = piutang::where('idpelanggan', $customerId)->get(); // Dapatkan invoice terkait customer

        $invoices->transform(function ($invoice) {
            // Hitung selisih hari antara tanggal pembayaran dan jatuh tempo
            $jatuhTempo = \Carbon\Carbon::parse($invoice->tgl_jatuh_tempo);
            $tanggalPembayaran = \Carbon\Carbon::now(); // Misalnya sekarang sebagai tanggal pembayaran
            $selisihHari = $tanggalPembayaran->diffInDays($jatuhTempo, false); // False agar negatif jika sebelum jatuh tempo

            // Inisialisasi variabel denda dan diskon
            $denda = 0;
            $diskon = 0;

            if ($selisihHari > 0) {
                // Pembayaran terlambat, hitung denda
                $denda = 0.01 * $selisihHari * $invoice->nominal; // 1% denda per hari
            } else {
                // Pembayaran tepat waktu atau lebih awal, hitung diskon
                $diskon = 0.01 * abs($selisihHari) * $invoice->nominal; // 1% diskon per hari
            }

            // Hitung total
            $total = $invoice->nominal + $denda - $diskon;

            // Tambahkan hasil perhitungan ke data invoice
            $invoice->denda = $denda;
            $invoice->diskon = $diskon;
            $invoice->total = $total;

            return $invoice;
        });

        return response()->json(['invoices' => $invoices]);
    }
}
