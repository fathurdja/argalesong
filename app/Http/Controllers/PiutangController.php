<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\masterDataPajak;
use App\Models\piutang;
use App\Models\TipePiutang;
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
        $pajakType = masterDataPajak::all();
        $customer = customer::all();
        $selectedType = null;
        $selectedTagihan = null;
        $jumlahKali = null;
        // Ambil kode jenis piutang yang dipilih dari request
        if ($request->has('jenis_form')) {
            $selectedType = TipePiutang::find($request->jenis_form); // Mengambil data berdasarkan ID
        }

        if ($request->has('jenis_tagihan')) {
            $selectedTagihan = $request->jenis_tagihan; // Ambil jenis tagihan yang dipilih

            // Jika jenis tagihan adalah "Berulang", ambil jumlah kali dari input
            if ($selectedTagihan == 'berulang' && $request->has('jumlah_kali')) {
                $jumlahKali = $request->jumlah_kali; // Ambil jumlah kali tagihan
            }
        }

        return view('piutangBaru.afiliasi', compact('piutangTypes', 'selectedType', 'customer', 'pajakType', 'selectedTagihan', 'jumlahKali'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input yang diterima
        $validatedData = $request->validate([
            'nama_pelanggan' => 'required|exists:customer,id_Pelanggan', // Pelanggan harus ada
            'tanggal_transaksi' => 'required|date',
            'jatuh_tempo' => 'required|date',
            'jarak_hari' => 'required|integer',
            'total_piutang' => 'required|string|min:0',
            'ppn_value' => 'required|string|min:0', // Pajak harus ada dalam masterpajak
            'diskon' => 'nullable|string|min:0',
            'jenis_form' => 'required|exists:tipepiutang,kodePiutang', // Kode piutang harus ada
        ]);

        $kodePiutang = $request->input('jenis_form'); // Kode piutang dari jenis_form
        $pajakValue = $request->input('ppn_value'); // Nilai pajak yang dipilih

        // Mengubah total_piutang dan ppn_value menjadi desimal
        $totalPiutang = str_replace(',', '.', preg_replace('/[^\d,]/', '', $validatedData['total_piutang']));
        $ppnValue = str_replace(',', '.', preg_replace('/[^\d,]/', '', $validatedData['ppn_value']));

        // Konversi ke format decimal (float) setelah pemisah desimal diperbaiki
        $totalPiutang = number_format((float) $totalPiutang, 2, '.', '');
        $ppnValue = number_format((float) $ppnValue, 2, '.', '');

        // Dapatkan nama pajak berdasarkan nilai pajak dari tabel pajak
        $pajak = masterDataPajak::where('nilai', $pajakValue)->first(); // Ambil detail pajak dari tabel Pajak
        $namaPajak = $pajak ? $pajak->name : null;
        $transactionID = $this->generateTransactionID();
        // Buat objek piutang baru
        $piutang = new piutang();

        // Isi data yang tervalidasi
        $piutang->idpelanggan = $validatedData['nama_pelanggan'];
        $piutang->no_invoice = $transactionID; // Relasi ke pelanggan
        $piutang->tgltra = $validatedData['tanggal_transaksi'];
        $piutang->tgl_jatuh_tempo = $validatedData['jatuh_tempo'];
        $piutang->jhari = $validatedData['jarak_hari'];
        $piutang->nominal = $totalPiutang; // Menggunakan nilai yang sudah diubah ke decimal
        $piutang->ppn = $ppnValue; // Menggunakan nilai yang sudah diubah ke decimal
        $piutang->pajak = $namaPajak; // Relasi ke masterpajak
        $piutang->diskon = $validatedData['diskon'] ?? 0; // Diskon bersifat opsional
        $piutang->kodepiutang = $kodePiutang; // Relasi ke jenis piutang

        // Simpan data piutang ke database
        $piutang->save();

        // Tampilkan alert sukses setelah data berhasil disimpan
        Alert::success('Berhasil!', 'Data piutang berhasil disimpan.');

        // Redirect ke halaman list piutang dengan pesan sukses
        return redirect()->route('piutang-types.create')->with('success', 'Data Piutang berhasil disimpan.');
    }
    function generateTransactionID()
    {
        // Ambil transaksi terakhir berdasarkan ID
        $lastTransaction = piutang::orderBy('id', 'desc')->first();

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
