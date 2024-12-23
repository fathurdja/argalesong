<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\masterCompany;
use App\Models\masterDataPajak;
use App\Models\piutang;
use App\Models\tipePelanggan;
use App\Models\TipePiutang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PiutangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {}

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $piutangTypes = TipePiutang::all();
        $tipePelanggan = tipePelanggan::all();
        $pajakTypes = masterDataPajak::whereNotIn('name', ['PPN'])->distinct()->pluck('name');
        $ppnTypes = masterDataPajak::where('name', 'PPN')
            ->select('nilai', 'id', 'name')
            ->get();

        $selectedType = null;
        $selectedTagihan = null;
        $jumlahKali = null;
        $selectedPajak = null;
        $filteredRates = [];
        $selectedTipePelanggan = $request->tipePelanggan;
        $selectedPerusahaan = null;

        // Ambil kode jenis piutang yang dipilih dari request
        if ($request->has('jenis_form')) {
            $selectedType = TipePiutang::find($request->jenis_form);
            // Mengambil data berdasarkan ID
        }

        if ($request->has('tipePelanggan')) {
            $selectedTipePelanggan = $request->tipePelanggan;
        }
        if ($request->has('perusahaan')) {
            $selectedPerusahaan = $request->perusahaan;
        }
        if ($request->has('jenis_tagihan')) {
            $selectedTagihan = $request->jenis_tagihan; // Ambil jenis tagihan yang dipilih

            // Jika jenis tagihan adalah "Berulang", ambil jumlah kali dari input
            if ($selectedTagihan == 'berulang' && $request->has('jumlah_kali')) {
                $jumlahKali = $request->jumlah_kali; // Ambil jumlah kali tagihan
            }
        }
        $customers = customer::all();
        $masterPerusahaan = masterCompany::all();
        return view('piutangBaru.afiliasi', compact('piutangTypes', 'ppnTypes', 'selectedType', 'customers', 'pajakTypes', 'filteredRates', 'selectedPajak', 'selectedTagihan', 'jumlahKali', 'tipePelanggan', 'selectedTipePelanggan', 'masterPerusahaan', 'selectedPerusahaan'));
    }

    public function getPajakRate($type)
    {
        $pajak = masterDataPajak::where('name', $type)->get(['kode_pajak', 'nilai']);

        if ($pajak->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'rates' => $pajak,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Tax rates not found',
        ], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pelanggan' => 'required|exists:customer,id_Pelanggan',
            'tanggal_transaksi' => 'required|date',
            'jatuh_tempo' => 'required|date',
            'jarak_hari' => 'required|integer',
            'dpp' => 'required|string|min:0',
            'total_piutang' => 'required|string|min:0',
            'ppn_value' => 'required|string|min:0',
            'pph_value' => 'required|string|min:0',
            'jenis_form' => 'required|exists:tipepiutang,kodePiutang',
            'jenis_tagihan' => 'required|in:tetap,berulang',
            'perusahaan' => 'required|exists:masterCompany,company_id',
            'jumlah_kali' => 'required_if:jenis_tagihan,berulang|nullable|integer|min:1',
        ]);

        // ... (logic untuk mengolah data yang sudah ada)

        $transactionID = $this->generateTransactionID();

        if ($validatedData['jenis_tagihan'] === 'tetap') {
            $this->createSingleInvoice($validatedData, $transactionID);
        } else {
            $this->createRecurringInvoices($validatedData, $transactionID);
        }

        Alert::success('Berhasil!', 'Data piutang berhasil disimpan.');
        return redirect()->route('riwayatPiutang');
    }

    private function createSingleInvoice($data, $transactionID)
    {
        Piutang::create([
            'idpelanggan' => $data['nama_pelanggan'],
            'no_invoice' => $transactionID,
            'tgltra' => $data['tanggal_transaksi'],
            'tgl_jatuh_tempo' => $data['jatuh_tempo'],
            'jhari' => $data['jarak_hari'],
            'dpp' => $this->convertToDecimal($data['dpp']),
            'nominal' => $this->convertToDecimal($data['total_piutang']),
            'ppn' => $this->convertToDecimal($data['ppn_value']),
            'pph' => $this->convertToDecimal($data['pph_value']),
            'pajak' => $this->getPajakName($data['ppn_value']),
            'kodepiutang' => $data['jenis_form'],
            'jenisTagihan' => 'tetap',
            'jumlahTagihan' => 1,
            'urutanTagihan' => 1,
            'idcompany' => $data['perusahaan'],
            'statusPembayaran' => 'BELUM LUNAS'
        ]);
    }
    private function convertToDecimal($value)
    {
        $value = str_replace(',', '.', preg_replace('/[^\d,]/', '', $value));
        return number_format((float) $value, 2, '.', '');
    }
    private function getPajakName($pajakValue)
    {
        $pajak = MasterDataPajak::where('nilai', $pajakValue)->first();
        return $pajak ? $pajak->name : null;
    }
    private function createRecurringInvoices($data, $transactionID)
    {
        $dueDate = Carbon::parse($data['jatuh_tempo']);

        // Nominal total dibagi dengan jumlah kali tagihan untuk jenis berulang
        $nominal = $this->convertToDecimal($data['total_piutang']);

        for ($i = 0; $i < $data['jumlah_kali']; $i++) {
            $transactionID = $this->generateTransactionID();
            Piutang::create([
                'idpelanggan' => $data['nama_pelanggan'],
                'no_invoice' => $transactionID,
                'tgltra' => $data['tanggal_transaksi'],
                'tgl_jatuh_tempo' => $dueDate->copy(),
                'jhari' => $data['jarak_hari'],
                'dpp' => $this->convertToDecimal($data['dpp']),
                'nominal' => number_format($nominal, 2, '.', ''), // Nominal per tagihan
                'ppn' => $this->convertToDecimal($data['ppn_value']),
                'pph' => $this->convertToDecimal($data['pph_value']),
                'pajak' => $this->getPajakName($data['ppn_value']),
                'kodepiutang' => $data['jenis_form'],
                'jenisTagihan' => 'berulang',
                'jumlahTagihan' => $data['jumlah_kali'],
                'urutanTagihan' => $i + 1,
                'idcompany' => $data['perusahaan'],
                'statusPembayaran' => 'BELUM LUNAS'
            ]);

            // Tambahkan 1 bulan untuk tagihan berikutnya
            $dueDate->addMonth();
        }
    }


    function generateTransactionID()
    {
        // Ambil transaksi terakhir berdasarkan ID
        $lastTransaction = piutang::orderBy('no_invoice', 'desc')->first();

        // Cek apakah ada transaksi sebelumnya
        if (!$lastTransaction) {
            // Jika tidak ada transaksi, mulai dengan INVC-0001
            $newNumber = 1;
        } else {
            // Jika ada transaksi, ambil angka terakhir dari ID Transaksi
            $lastID = $lastTransaction->no_invoice; // Ambil ID transaksi terakhir
            $lastNumber = intval(str_replace('INVC-', '', $lastID)); // Buang bagian 'INVC-' dan ambil angkanya

            // Tambahkan 1 ke angka terakhir
            $newNumber = $lastNumber + 1;
        }

        // Format nomor transaksi dengan leading zeros
        $newTransactionID = 'INVC-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        return $newTransactionID;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
