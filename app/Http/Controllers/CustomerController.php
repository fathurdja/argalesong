<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\tipePelanggan;
use App\Models\TipePiutang;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the search input from the request
        $search = $request->input('search');

        // Initialize $customer to null
        $customer = null;

        // If search is provided, search by id_Pelanggan or name
        if ($search) {
            $customer = Customer::where('id_Pelanggan', $search)
                ->orWhere('name', 'like', '%' . $search . '%')
                ->first();
        }

        // If search didn't return a result, find the customer by ID
        $id = $request->input('id'); // Assuming 'id' is passed as a request parameter
        if (!$customer && $id) {
            $customer = Customer::with(['tipePelanggan', 'tipePiutang'])->find($id);
        }

        // Ensure that the customer and related tipePelanggan/tipePiutang exist
        $tipePelangganName = null;
        $tipePiutangName = null;
        if ($customer) {
            if ($customer->tipePelanggan) {
                $tipePelangganName = $customer->tipePelanggan->name;
            }
            if ($customer->tipePiutang) {
                $tipePiutangName = $customer->tipePiutang->name;
            }
        }

        // Return the view with the customer, tipePelangganName, and tipePiutangName
        return view('daftarPelangggan.formedit', compact('customer', 'tipePelangganName', 'tipePiutangName'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customerType = tipePelanggan::all();
        $debtType = TipePiutang::all();
        return view('daftarPelangggan.formBaru', compact('customerType', 'debtType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'tipe_pelanggan' => 'required',
            'tipe_piutang' => 'required',
            'name' => 'required|string|max:255',
            'ktp_option' => 'required',
            'ktp' => 'nullable|string|size:16',
            'npwp_option' => 'required',
            'npwp' => 'nullable|string|size:15',
            'kode_pelanggan' => 'nullable|string',
            'sharing' => 'nullable|numeric',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp' => 'nullable|string|max:20',
            'telepon' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'kota' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'catatan' => 'nullable|string|max:255',
        ]);

        // Create a new customer instance and save it to the database
        $customer = new Customer();
        $customer->idtypepelanggan = $validated['tipe_pelanggan'];
        $customer->idtypepiutang = $validated['tipe_piutang'];
        $customer->name = $validated['name'];
        $customer->ktp = $validated['ktp_option'] === 'ada' ? $validated['ktp'] : null;
        $customer->npwp = $validated['npwp_option'] === 'ada' ? $validated['npwp'] : null;
        $customer->id_Pelanggan = $validated['kode_pelanggan'];
        $customer->sharing = $validated['sharing'];
        $customer->alamat = $validated['alamat'];
        $customer->email = $validated['email'];
        $customer->whatsapp = $validated['whatsapp'];
        $customer->telepon = $validated['telepon'];
        $customer->fax = $validated['fax'];
        $customer->kota = $validated['kota'];
        $customer->kode_pos = $validated['kode_pos'];
        $customer->notes = $validated['catatan'];

        // Save the customer to the database
        $customer->save();

        // Redirect back or to another page
        return redirect()->route('customer.index')->with('success', 'Customer has been added successfully');
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
        // Retrieve the customer along with related tipePelanggan and tipePiutang
        $customer = Customer::with(['tipePelanggan', 'tipePiutang'])->find($id);

        // Ensure the customer exists
        if (!$customer) {
            return redirect()->route('customer.index')->with('error', 'Customer not found');
        }

        // Pass customer data and related names to the view
        $tipePelangganName = $customer->tipePelanggan ? $customer->tipePelanggan->name : null;
        $tipePiutangName = $customer->tipePiutang ? $customer->tipePiutang->name : null;

        // Retrieve all tipePelanggan and tipePiutang options for the select dropdowns
        $tipePelangganOptions = TipePelanggan::all();
        $tipePiutangOptions = TipePiutang::all();

        return view('daftarPelangggan.editform', compact('customer', 'tipePelangganName', 'tipePiutangName', 'tipePelangganOptions', 'tipePiutangOptions'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'ktp' => 'required|string|max:16',
            'npwp' => 'nullable|string|max:15',
            'tipe_pelanggan' => 'required|exists:tipepelanggan,kodeType', // Ensure the tipe pelanggan exists in the tipepelanggan table
            'tipe_piutang' => 'required|exists:tipepiutang,kodePiutang', // Ensure the tipe piutang exists in the tipepiutang table
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp' => 'nullable|string|max:20',
            'telepon' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'kota' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'sharing' => 'nullable|numeric|min:0|max:100',
            'catatan' => 'nullable|string',
        ]);

        // Find the customer by id
        $customer = Customer::findOrFail($id);

        // Update customer fields with validated data
        $customer->name = $validatedData['name'];
        $customer->ktp = $validatedData['ktp'];
        $customer->npwp = $validatedData['npwp'];
        $customer->idtypepelanggan = $validatedData['tipe_pelanggan']; // Store the foreign key for tipe pelanggan
        $customer->idtypepiutang = $validatedData['tipe_piutang']; // Store the foreign key for tipe piutang
        $customer->alamat = $validatedData['alamat'];
        $customer->email = $validatedData['email'];
        $customer->whatsapp = $validatedData['whatsapp'];
        $customer->telepon = $validatedData['telepon'];
        $customer->fax = $validatedData['fax'];
        $customer->kota = $validatedData['kota'];
        $customer->kode_pos = $validatedData['kode_pos'];
        $customer->sharing = $validatedData['sharing'];
        $customer->notes = $validatedData['catatan'];

        // Save the updated customer
        $customer->save();

        // Redirect back to the customer list with a success message
        return redirect()->route('customer.index')->with('success', 'Customer updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
