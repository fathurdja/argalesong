<?php

namespace App\Http\Controllers;

use App\Models\tipePelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class kp_pelangganController extends Controller
{
    public function index(Request $request)
    {
        $tipePelanggan = tipePelanggan::all();

        // Fetch all customers for the dropdown menu
        $customers = DB::table('customer')
            ->join('tipepelanggan', 'customer.idtypepelanggan', '=', 'tipepelanggan.KodeType') // Sesuaikan dengan kolom relasi
            ->select('customer.id_Pelanggan', 'customer.name', 'tipepelanggan.kodeType as idtypepelanggan')
            ->get();

        $selectedTipePelanggan = $request->has('tipePelanggan') ? $request->tipePelanggan : null;
        $data = [];
        $secondResult = [];

        // Display the form with customer dropdown and date range inputs
        return view('kartuPelanggan.pelanggan', compact('customers', 'tipePelanggan', 'selectedTipePelanggan', 'data', 'secondResult'));
        // return view('kartuPelanggan.pelanggan');
    }

    // Fetch data based on customer ID and date range using stored procedure
    public function fetchData(Request $request)
    {
        // Validate the input
        $request->validate([
            'nama_pelanggan' => 'required|exists:customer,id_Pelanggan', // assuming you have a customers table
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // Retrieve the input values
        $customerId = $request->input('nama_pelanggan');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        // try {
        //     $customers = DB::table('customer')->select('id_Pelanggan', 'name')->get();
        //     $data = DB::select('CALL kartu_piutang(?, ?, ?)', [$request->customer_id, $request->start_date, $request->end_date]);
        //     dd($data);
        //     return view('kartuPelanggan.pelanggan', compact('data', 'customers'));
        // } catch (\Exception $e) {
        //     dd($e->getMessage()); // This will display any error messages from the stored procedure call
        // }
        //$data = DB::select('CALL kartu_piutang(?, ?, ?)', [$customerId, $startDate, $endDate]);
        $pdo = DB::connection()->getPdo();
        $stmt = $pdo->prepare('CALL kartu_piutang(?, ?, ?)');
        $stmt->execute([$customerId, $startDate, $endDate]);

        // Array untuk menampung semua result sets
        $results = [];
        do {
            $results[] = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } while ($stmt->nextRowset());

        // Tutup cursor
        $stmt->closeCursor();
        // Ambil hasil pertama dan kedua
        $data = $results[0] ?? [];
        $secondResult = $results[1] ?? [];

        $tipePelanggan = tipePelanggan::all();

        // Fetch all customers for the dropdown menu
        $customers = DB::table('customer')
            ->join('tipepelanggan', 'customer.idtypepelanggan', '=', 'tipepelanggan.KodeType') // Sesuaikan dengan kolom relasi
            ->select('customer.id_Pelanggan', 'customer.name', 'tipepelanggan.kodeType as idtypepelanggan')
            ->get();

        $selectedTipePelanggan = $request->has('tipePelanggan') ? $request->tipePelanggan : null;
        //dd($data);
        //dd($data, $secondResult);
        // Pass the data to the view
        return view('kartuPelanggan.pelanggan', compact('data', 'customers', 'tipePelanggan', 'selectedTipePelanggan', 'secondResult'));
    }
}
