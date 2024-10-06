@extends('layouts.app')

@section('content')
    <div class="container mt-5 mx-auto">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Form for Payment Input -->
        <div class="bg-white p-6 mx-2 rounded-lg shadow-md max-w-6xl ml-9">
            <h1 class="text-2xl font-bold mb-4">PEMBAYARAN PIUTANG</h1>
            <form method="POST" action="{{ route('pembayaran-piutang.store') }}">
                @csrf

                <!-- Nomor Invoice Input Section -->
                <div class="mb-4">

                    <!-- Container for Invoice Rows -->
                    <div id="invoice-container">

                        <div class="mb-4">
                            <!-- Tanggal Transaksi -->
                            <label for="tanggal_transaksi" class="block text-sm font-medium text-gray-700">Tanggal
                                Transaksi</label>
                            <input type="date" name="tanggal_transaksi" id="tanggal_transaksi"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Template for dynamic rows -->
                        <div class="flex space-x-2 mb-2 invoice-row">
                            <button type="button" class="bg-blue-500 text-white text-sm px-2 py-1 rounded-full mt-2"
                                onclick="addInvoiceRow()">+</button>
                            <input type="text" name="nomor_invoice"
                                class="border border-gray-300 rounded px-2 py-1 text-sm w-1/4" placeholder="Nomor Invoice"
                                onkeydown="if(event.key === 'Enter'){ fetchInvoice(this); return false; }">

                            <input type="text" name="nama_pelanggan[]"
                                class="border border-gray-300 rounded px-2 py-1 text-sm w-1/4" placeholder="Nama Pelanggan"
                                readonly>

                            <input type="date" name="jatuh_tempo[]"
                                class="border border-gray-300 rounded px-2 py-1 text-sm w-1/4" placeholder="Jatuh Tempo"
                                readonly>

                            <input type="number" name="piutang_belum_dibayar[]"
                                class="border border-gray-300 rounded px-2 py-1 text-sm w-1/4"
                                placeholder="Piutang Belum Dibayar" readonly>

                            <input type="number" name="denda[]"
                                class="border border-gray-300 rounded px-2 py-1 text-sm w-1/4" placeholder="Denda">

                            <input type="number" name="diskon[]"
                                class="border border-gray-300 rounded px-2 py-1 text-sm w-1/4" placeholder="Diskon">

                            <button type="button" class="bg-red-500 text-white text-sm px-2 py-1 rounded-full"
                                onclick="removeRow(this)">x</button>
                        </div>
                    </div>

                </div>

                <!-- Total Semua Piutang -->
                <div class="mt-5">
                    <label for="total_piutang" class="block text-sm font-medium text-gray-700">Total Semua Piutang</label>
                    <input type="number" name="total_piutang" id="total_piutang"
                        class="border border-gray-300 p-2 rounded-lg" placeholder="Total Piutang" readonly>
                </div>

                <!-- Nominal yang Dibayar -->
                <div class="mt-5">
                    <label for="nominal_dibayar" class="block text-sm font-medium text-gray-700">Nominal yang
                        Dibayar</label>
                    <input type="number" name="nominal_dibayar" class="border border-gray-300 p-2 rounded-lg"
                        placeholder="Nominal yang Dibayar">
                </div>

                <!-- Submit Payment Button -->
                <div class="mt-6 px-4">
                    <button type="submit" class="w-24 bg-blue-500 text-white p-2 rounded-md">Bayar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for dynamic functionality -->
@endsection
@push('script')
    // Function to add a new invoice row
    function addInvoiceRow() {
    let container = document.getElementById('invoice-container');
    let newRow = container.querySelector('.invoice-row').cloneNode(true);

    // Clear the values for the new row
    newRow.querySelectorAll('input').forEach(input => input.value = '');
    container.appendChild(newRow);
    }

    // Function to remove an invoice row
    function removeRow(button) {
    let row = button.closest('.invoice-row');
    if (document.querySelectorAll('.invoice-row').length > 1) {
    row.remove();
    }
    }

    // Function to fetch invoice details based on entered invoice number
    function fetchInvoice(input) {
    let invoiceNumber = input.value;
    let row = input.closest('.invoice-row');

    if (invoiceNumber) {
    fetch(`/pembayaran-piutang/fetch-invoice-details?nomor_invoice=${invoiceNumber}`)
    .then(response => {
    if (!response.ok) {
    throw new Error('Network response was not ok');
    }
    return response.json(); // Ambil sebagai JSON
    })
    .then(data => {
    if (data.error) {
    alert(data.error);
    } else {
    // Set values from data
    row.querySelector('input[name="nama_pelanggan[]"]').value = data.nama_pelanggan || '';
    row.querySelector('input[name="jatuh_tempo[]"]').value = data.jatuh_tempo || '';
    row.querySelector('input[name="piutang_belum_dibayar[]"]').value = data.piutang_belum_dibayar || 0;
    }
    })
    .catch(error => console.error('Error fetching invoice details:', error));
    }
    }
@endpush
