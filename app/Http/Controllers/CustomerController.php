<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\masterCompany;
use App\Models\tipePelanggan;
use App\Models\TipePiutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the search input from the request
        $search = $request->input('search');
        $companyFilter = $request->input('idcompany'); // Filter perusahaan

        // Ambil semua perusahaan untuk dropdown
        $perusahaan = masterCompany::all();

        // Query daftar pelanggan dengan pencarian dan filter perusahaan
        $daftarPelanggan = Customer::with(['tipePelanggan', 'company'])
            ->when($search, function ($query) use ($search) {
                $query->where('id_Pelanggan', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            })
            ->when($companyFilter, function ($query) use ($companyFilter) {
                $query->where('idcompany', $companyFilter);
            })
            ->paginate(10); // Anda bisa mengatur jumlah item per halaman

        return view('daftarPelangggan.formedit', compact('daftarPelanggan', 'perusahaan'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customerType = tipePelanggan::all();
        $debtType = TipePiutang::all();
        $masterPerusahaan = masterCompany::all();
        return view('daftarPelangggan.formBaru', compact('customerType', 'debtType', 'masterPerusahaan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'tipe_pelanggan' => 'required',
            'perusahaan' => 'required',
            'name' => 'required|string|max:255',
            'ktp' => 'required|string|size:16|unique:customer,ktp', // KTP harus unik
            'npwp_option' => 'nullable',
            'npwp' => 'nullable|string', // NPWP harus unik
            'kode_pelanggan' => 'nullable|string|size:8|unique:customer,id_Pelanggan', // id_Pelanggan harus unik
            'sharing' => 'nullable|numeric',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customer,email', // Email harus unik
            'whatsapp' => 'nullable|string|max:20|unique:customer,whatsapp', // WhatsApp harus unik
            'telepon' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'kota' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'catatan' => 'nullable|string|max:255',
        ]);

        // Create a new customer instance and save it to the database
        $customer = new Customer();
        $customer->idtypepelanggan = $validated['tipe_pelanggan'];
        $customer->name = $validated['name'];
        $customer->ktp =  $validated['ktp'];
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
        $customer->idcompany = $validated['perusahaan'];
        // Save the customer to the database
        $customer->save();
        Alert::success('Berhasil', 'Customer baru Telah Di Tambahkan');
        // Redirect back or to another page
        return redirect()->route('customer.index');
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
        $customer = Customer::with('tipePelanggan')->find($id);
        // Ensure the customer exists
        if (!$customer) {
            return redirect()->route('customer.index')->with('error', 'Customer not found');
        }

        // Pass customer data and related names to the view
        $tipePelangganName = $customer->tipePelanggan ? $customer->tipePelanggan->name : null;

        // Retrieve all tipePelanggan and tipePiutang options for the select dropdowns
        $tipePelangganOptions = TipePelanggan::all();
        $masterPerusahaan = masterCompany::all();
        return view('daftarPelangggan.editform', compact('customer', 'tipePelangganName',  'tipePelangganOptions', 'masterPerusahaan'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Cari customer berdasarkan id
        $customer = \App\Models\Customer::findOrFail($id);

        // Validasi data dari form
        $validatedData = $request->validate([
            'tipe_pelanggan' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'ktp' => 'required|string|size:16',
            'npwp' => 'nullable|string',
            'sharing' => 'nullable|numeric',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp' => 'nullable|string|max:15',
            'telepon' => 'nullable|string|max:15',
            'fax' => 'nullable|string|max:15',
            'kota' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:5',
            'catatan' => 'nullable|string|max:255',
            'perusahaan' => 'required|string|max:5',
        ]);

        // Update data customer
        $customer->update($validatedData);

        // Flash message (notifikasi)
        Alert::success('Berhasil!', 'Data customer telah berhasil diperbarui.');

        // Redirect kembali ke halaman daftar customer dengan pesan sukses
        return redirect()->route('customer.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getCustomers($idcompany)
    {
        $customers = Customer::where('idcompany', $idcompany)->get(['id_Pelanggan', 'name']);
        return response()->json($customers);
    }
}
