<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\denda;
use App\Models\masterCompany;
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
        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
        // Mengambil semua pelanggan untuk ditampilkan di select option
        $customers = DB::table('detailpiutang as x')
            ->leftJoin('vtbpiutang as y', 'x.no_invoice', '=', 'y.idpiutang')
            ->leftJoin('customer as c', 'x.idpelanggan', '=', 'c.id_Pelanggan') // Join with the customer table
            ->select(
                'x.id',
                'x.idpelanggan',
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
                'y.xpiutang as tagihan',
                'c.name as customer_name',  // Add the customer name or any other columns from customer table// Example: adding customer address
            )
            ->where('y.xpiutang', '>', 0)
            ->groupBy('x.idpelanggan', 'c.name')
            ->get();

        // Debug: Cek status pembayaran yang ada
        if ($selectedCustomerId) {
            // Cek dulu status yang ada di database
            $statusCek = Piutang::where('idpelanggan', $selectedCustomerId)
                ->select('statusPembayaran')
                ->distinct()
                ->get();
        } else {
            $invoices = collect();
        }

        // Menggunakan method sum() pada collection untuk menjumlahkan field nominal
        $totalKeseluruhan = $invoices->sum('nominal');  // Piutang keseluruhan
        $company = masterCompany::all();
        return view('pembayaran_piutang.pembayaran', compact('customers', 'invoices', 'totalKeseluruhan', 'selectedCustomerId', 'company'));
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
                ->where(function ($query) {
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
            'original_denda' => 'nullable|numeric|min:0',
            'total_piutang' => 'nullable|numeric|min:0',
        ]);

        $totalpiutang = floatval($request->total_piutang);
        $nominaldibayar = floatval($request->nominal_dibayar);

        // Validasi tambahan: Nominal dibayar tidak boleh lebih besar dari total piutang
        if ($nominaldibayar > $totalpiutang) {
            Alert::error('Error ', 'Nominal dibayar tidak boleh lebih besar dari total piutang');
            return redirect()->back();
        }

        // Validasi custom untuk invoices
        if (!$request->has('invoices') || empty($request->invoices)) {
            Alert::error('Error ', 'Minimal satu invoice harus dipilih.');
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $totalNominalDibayar = $nominaldibayar;
            $idTransaksi = $this->generateTransactionId();

            foreach ($request->invoices as $pembayaran) {
                // Validasi setiap invoice
                if (empty($pembayaran['nomor_invoice'])) {
                    continue; // Skip jika nomor invoice kosong
                }

                $diskon = floatval($pembayaran['diskon'] ?? 0);
                $denda = floatval($pembayaran['denda'] ?? 0);

                DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
                $detailPiutangs = DB::select(
                    'SELECT x.id, x.idpelanggan, x.tgltra, x.no_invoice, x.tgl_jatuh_tempo, 
                            x.jhari, x.jenistagihan, x.ppn, x.pajak, x.urutantagihan, 
                            x.jumlahTagihan, x.kodepiutang, x.nominal, y.xpiutang as tagihan
                     FROM detailpiutang x
                     LEFT JOIN vtbpiutang y ON (x.no_invoice = y.idpiutang)
                     WHERE x.no_invoice = ?
                     ORDER BY x.urutantagihan',
                    [$pembayaran['nomor_invoice']]
                );

                if (empty($detailPiutangs)) {
                    throw new \Exception("Invoice {$pembayaran['nomor_invoice']} tidak ditemukan.");
                }

                foreach ($detailPiutangs as $detailPiutang) {
                    if ($totalNominalDibayar <= 0) break;

                    $tagihan = floatval($detailPiutang->tagihan);

                    // **Cek Status Pembayaran Sebelum Memproses**
                    $status = $tagihan > 0 ? 'SEBAGIAN' : 'LUNAS';

                    // Hitung pembayaran yang akan diproses
                    if ($totalNominalDibayar >= $tagihan) {
                        $pembayaranNow = $tagihan;
                        $status = 'LUNAS'; // Jika lunas
                    } else {
                        $pembayaranNow = $totalNominalDibayar;
                        $status = 'SEBAGIAN'; // Jika masih tersisa
                    }

                    $sisa = $tagihan - $pembayaranNow;

                    // Simpan pembayaran ke tabel pembayaranpiutang
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
                            $pembayaranNow,
                            $tagihan,
                            $sisa,
                            $diskon,
                            $denda,
                            $request->mode_bayar
                        ]
                    );

                    // **Update Status di DetailPiutang**
                    DB::update(
                        'UPDATE detailpiutang 
                         SET statusPembayaran = ?
                         WHERE no_invoice = ?',
                        [$status, $detailPiutang->no_invoice]
                    );

                    $totalNominalDibayar -= $pembayaranNow;

                    // Simpan denda
                    $originalDenda = new denda();
                    $originalDenda->idpelanggan = $detailPiutang->idpelanggan;
                    $originalDenda->no_invoice = $detailPiutang->no_invoice;
                    $originalDenda->nominal = $denda;
                    $originalDenda->piutang = $totalNominalDibayar;
                    $originalDenda->save();
                }
            }

            // Final validasi apakah semua piutang terbayar
            if ($totalNominalDibayar > 0) {
                throw new \Exception("Nominal dibayar tidak boleh lebih besar dari total piutang yang tersisa.");
            }

            DB::commit();
            Alert::success('Berhasil!', 'Piutang Berhasil di Bayar');
            return redirect()->route('riwayatPiutang');
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
        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        // Query untuk mendapatkan data dari tabel `detailpiutang` dengan `leftJoin` ke `vtbpiutang`
        $invoices = DB::table('detailpiutang as x')
            ->leftJoin('vtbpiutang as y', 'x.no_invoice', '=', 'y.idpiutang')
            ->select(
                'x.id',
                'x.idpelanggan',
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
                'y.xpiutang as tagihan'
            )
            ->where('x.idpelanggan', $customerId)
            ->where('y.xpiutang', '>', 0)
            ->get();

        // Menghitung denda, diskon, dan total per invoice
        $invoices->transform(function ($invoice) {
            $denda = 0;
            $diskon = 0;
            // Hitung total invoice
            $total = $invoice->tagihan + $denda - $diskon;
            // Tambahkan data denda, diskon, dan total ke invoice
            $invoice->denda = $denda;
            $invoice->diskon = $diskon;
            $invoice->total = $total;
            return $invoice;
        });

        return response()->json(['invoices' => $invoices]);
    }

    public function getCustomersByCompany($idcompany)
    {
        $customers = DB::table('detailpiutang as x')
            ->leftJoin('vtbpiutang as y', 'x.no_invoice', '=', 'y.idpiutang')
            ->leftJoin('customer as c', 'x.idpelanggan', '=', 'c.id_Pelanggan')
            ->select(
                'x.idpelanggan',
                'c.name as customer_name',
                'c.idcompany',
                DB::raw('SUM(y.xpiutang) as total_piutang') // Hitung total piutang
            )
            ->where('c.idcompany', $idcompany) // Filter berdasarkan perusahaan
            ->where('y.xpiutang', '>', 0) // Hanya pelanggan dengan piutang > 0
            ->groupBy('x.idpelanggan', 'c.name', 'c.idcompany') // Group by pelanggan dan perusahaan
            ->get();

        return response()->json(['customers' => $customers]);
    }
}
