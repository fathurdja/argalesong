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
            'nama_pelanggan' => 'required|exists:customer,id_Pelanggan', // Ensure the customer exists
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date', // Ensure end_date is not before start_date
        ]);

        // Retrieve the input values
        $customerId = $request->input('nama_pelanggan');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Fetch the data using the stored procedure
        $data = DB::select('CALL kartu_piutang(?, ?, ?)', [$customerId, $startDate, $endDate]);

        // Retrieve the selected customer's details
        $selectedCustomer = DB::table('customer')
            ->where('id_Pelanggan', $customerId)
            ->select('id_Pelanggan', 'name')
            ->first(); // Fetch only the selected customer's details

        // Fetch all customers for the dropdown menu
        $customers = DB::table('customer')
            ->join('tipepelanggan', 'customer.idtypepelanggan', '=', 'tipepelanggan.KodeType') // Adjust if needed
            ->select('customer.id_Pelanggan', 'customer.name', 'tipepelanggan.kodeType as idtypepelanggan')
            ->get();

        // Fetch all types of customers
        $tipePelanggan = tipePelanggan::all();

        // Determine the selected type of customer
        $selectedTipePelanggan = $request->has('tipePelanggan') ? $request->tipePelanggan : null;

        // Pass the data to the view
        return view('kartuPelanggan.pelanggan', compact(
            'data',
            'customers',
            'tipePelanggan',
            'selectedTipePelanggan',
            'selectedCustomer',
            'startDate',
            'endDate'
        ));
    }
}
