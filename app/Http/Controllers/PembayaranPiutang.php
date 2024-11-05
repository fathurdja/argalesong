<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\denda;
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

    // Debug: Cek status pembayaran yang ada
    if ($selectedCustomerId) {
        // Cek dulu status yang ada di database
        $statusCek = Piutang::where('idpelanggan', $selectedCustomerId)
            ->select('statusPembayaran')
            ->distinct()
            ->get();
        
        \Log::info('Status pembayaran yang ada:', $statusCek->toArray());
        
        // Query yang diperbaiki
        $invoices = Piutang::where('idpelanggan', $selectedCustomerId)
            ->where(function($query) {
                $query->where('statusPembayaran', '=', 'BELUM LUNAS')
                      ->orWhere('statusPembayaran', '=', 'BELUMLUNAS')
                      ->orWhere('statusPembayaran', '=', 'SEBAGIAN');
            })
            ->get();
    } else {
        $invoices = collect();
    }

    // Menggunakan method sum() pada collection untuk menjumlahkan field nominal
    $totalKeseluruhan = $invoices->sum('nominal');  // Piutang keseluruhan

    return view('pembayaran_piutang.pembayaran', compact('customers', 'invoices', 'totalKeseluruhan', 'selectedCustomerId'));
}


    public function proses(Request $request)
    {
        // Validate that the customer name exists in the database
        $validatedData = $request->validate([
            'invoices.*.nama_pelanggan' => 'required|exists:pelanggan,name',
        ]);

        $invoices = $request->input('invoices', []); // Retrieve invoice data from request
        $tanggalTransaksi = $request->input('tanggal_transaksi'); // Retrieve transaction date
        $totalKeseluruhan = 0; // Initialize the total amount to be paid

        foreach ($invoices as $index => $invoice) {
            // Fetch unpaid invoices (BELUM LUNAS) for the specified customer
            $detailPiutangCollection = piutang::with(['pelanggan', 'pajak', 'jenisPiutang'])
            ->where(function($query) {
                $query->where('statusPembayaran', '=', 'BELUM LUNAS')
                      ->orWhere('statusPembayaran', '=', 'BELUMLUNAS')
                      ->orWhere('statusPembayaran', '=', 'SEBAGIAN');
            })
            ->whereHas('pelanggan', function ($query) use ($invoice) {
                $query->where('name', $invoice['nama_pelanggan']);
            })
            ->get();
            // Only process if there are unpaid invoices
            if ($detailPiutangCollection->isNotEmpty()) {
                foreach ($detailPiutangCollection as $detailPiutang) {
                    $nominal = (float) $detailPiutang->nominal;

                    // Set customer data, due date, and unpaid amount
                    $invoices[$index]['nama_pelanggan'] = $detailPiutang->pelanggan->name ?? '';
                    $invoices[$index]['idpelanggan'] = $detailPiutang->idpelanggan ?? '';
                    $invoices[$index]['jatuh_tempo'] = $detailPiutang->tgl_jatuh_tempo;
                    $invoices[$index]['piutang_belum_dibayar'] = $nominal;

                    // Calculate the difference in days between transaction date and due date
                    $jatuhTempo = Carbon::parse($detailPiutang->tgl_jatuh_tempo);
                    $tanggalTransaksiCarbon = Carbon::parse($tanggalTransaksi);
                    $selisihHari = $jatuhTempo->diffInDays($tanggalTransaksiCarbon, false);

                    // Calculate penalty and discount
                    $denda = 0;
                    $diskon = 0;
                    if ($selisihHari > 0) {
                        // If payment is late
                        $denda = 0.01 * $selisihHari * $nominal; // 1% penalty per day
                        $invoices[$index]['denda'] = $denda;
                        $invoices[$index]['diskon'] = 0;
                    } else {
                        // If payment is on time or early
                        $diskon = 0.01 * abs($selisihHari) * $nominal; // 1% discount per day
                        $invoices[$index]['diskon'] = $diskon;
                        $invoices[$index]['denda'] = 0;
                    }

                    // Calculate the total amount for this invoice
                    $amountToPay = $nominal - $diskon + $denda;
                    $invoices[$index]['amount_to_pay'] = $amountToPay;

                    // Add to the overall total
                    $totalKeseluruhan += $amountToPay;
                }
            }
        }

        // Return invoice data and total amount to the view
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

                    $originalDenda = new denda();
                    $originalDenda->idpelanggan =  $detailPiutang->idpelanggan;
                    $originalDenda->nominal = $denda;
                    $originalDenda->piutang = $totalNominalDibayar;
                    $originalDenda->save();
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
