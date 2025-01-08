<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\masterCompany;
use App\Models\tipePelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class kp_pelangganController extends Controller
{
    public function index(Request $request)
    {
        $tipePelanggan = tipePelanggan::all();
        $perusahaan = masterCompany::all();
        $customerId = $request->input('nama_pelanggan');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $selectedPerusahaan = $request->input('idcompany');
        // Fetch all customers for the dropdown menu
        $customers = DB::table('customer')
            ->select('customer.id_Pelanggan', 'customer.name', 'customer.idcompany')->where('customer.idcompany', '=', $selectedPerusahaan)
            ->get();


        $data = [];
        $secondResult = [];

        // Display the form with customer dropdown and date range inputs
        return view('kartuPelanggan.pelanggan', compact('customers', 'tipePelanggan', 'selectedPerusahaan', 'data', 'secondResult', 'perusahaan', 'startDate', 'endDate'));
        // return view('kartuPelanggan.pelanggan');
    }

    // Fetch data based on customer ID and date range using stored procedure
    public function fetchData(Request $request)
    {
        // Validate the input
        $request->validate([
            'id_Pelanggan_actual' => 'required|exists:customer,id_Pelanggan', // Ensure the customer exists
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date', // Ensure end_date is not before start_date
        ]);

        // Retrieve the input values
        $customerId = $request->input('id_Pelanggan_actual');
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
            ->join('mastercompany', 'customer.idcompany', '=', 'mastercompany.company_id') // Adjust if needed
            ->select('customer.id_Pelanggan', 'customer.name', 'mastercompany.company_id as kodeperusahaan')
            ->get();

        // Fetch all types of customers

        $perusahaan = masterCompany::all();

        // Determine the selected type of customer
        $selectedPerusahaan = $request->has('Perusahaan') ? $request->company_id : null;
        // Pass the data to the view
        return view('kartuPelanggan.pelanggan', compact(
            'data',
            'customers',
            'selectedPerusahaan',
            'selectedCustomer',
            'startDate',
            'endDate',
            'perusahaan'
        ));
    }

    public function getCustomersByCompany($idcompany)
    {
        // Ambil pelanggan berdasarkan idcompany
        $customers = DB::table('customer')
            ->where('idcompany', $idcompany)
            ->select('id_Pelanggan', 'name')
            ->get();

        return response()->json($customers); // Kirim data dalam format JSON
    }
}
