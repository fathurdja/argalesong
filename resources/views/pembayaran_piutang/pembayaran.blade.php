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
        <div class="bg-white p-6 mx-2 rounded-lg shadow-md  max-w-5xl ml-9">
            <h1 class="text-2xl font-bold mb-4">PEMBAYARAN PIUTANG</h1>
            <form method="POST" action="{{ route('pembayaran-piutang.proses') }}">
                @csrf

                <!-- Transaction Date -->
                <div class="mb-4">
                    <label for="tanggal_transaksi" class="block text-sm font-medium text-gray-700">Tanggal Transaksi</label>
                    <input type="date" name="tanggal_transaksi" id="tanggal_transaksi"
                        value="{{ old('tanggal_transaksi', now()->format('Y-m-d')) }}"
                        class="mt-1 block w-64 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm h-10"
                        required>
                </div>

                <!-- Dynamic Invoice Rows -->
                <div class="mb-4 overflow-x-auto" id="invoice-container">
                    <div class="grid grid-cols-9 gap-10 mb-2 min-w-max">
                        <label class="text-sm font-medium text-gray-700 w-40">Nomor Invoice</label>
                        <label class="text-sm font-medium text-gray-700 w-50">Nama Pelanggan</label>
                        <label class="text-sm font-medium text-gray-700 w-50">Tanggal Jatuh Tempo</label>
                        <label class="text-sm font-medium text-gray-700 w-48">Piutang</label>
                        <label class="text-sm font-medium text-gray-700 w-48">Diskon</label>
                        <label class="text-sm font-medium text-gray-700 w-48">Denda</label>
                        <label class="text-sm font-medium text-gray-700 w-48">Total Piutang</label>

                    </div>
                    @foreach (old('invoices', [0]) as $index => $invoice)
                        <div class="grid grid-cols-8 gap-4 mb-2 invoice-row min-w-max">

                            <input type="text" name="invoices[{{ $index }}][nomor_invoice]"
                                class="border border-gray-300 rounded px-2 py-1 text-sm" placeholder="Nomor Invoice"
                                value="{{ old("invoices.$index.nomor_invoice") }}" required>
                            <input type="text" name="invoices[{{ $index }}][nama_pelanggan]"
                                class="border border-gray-300 rounded px-2 py-1 text-sm " placeholder="Nama Pelanggan"
                                value="{{ old("invoices.$index.nama_pelanggan") }}" readonly>
                            <input type="date" name="invoices[{{ $index }}][jatuh_tempo]"
                                class="border border-gray-300 rounded px-2 py-1 text-sm " placeholder="Jatuh Tempo"
                                value="{{ old("invoices.$index.jatuh_tempo") }}" readonly>
                            <input type="text" name="invoices[{{ $index }}][piutang_belum_dibayar]"
                                class="border border-gray-300 rounded px-4 py-1 text-sm "
                                placeholder="Piutang Belum Dibayar"
                                value="Rp {{ number_format(old("invoices.$index.piutang_belum_dibayar", 0), 0, ',', '.') }}"
                                readonly>
                            <input type="text" name="invoices[{{ $index }}][diskon]"
                                class="border border-gray-300 rounded px-4 py-1 text-sm " placeholder="Diskon"
                                value="Rp {{ number_format(old("invoices.$index.diskon", 0), 0, ',', '.') }}" readonly>

                            <input type="text" name="invoices[{{ $index }}][denda]"
                                class="border border-gray-300 rounded px-4 py-1 text-sm " placeholder="Denda"
                                value=" Rp {{ number_format(old("invoices.$index.denda", 0), 0, ',', '.') }}" readonly>

                            <input type="text" name="invoices[{{ $index }}][amount_to_pay]"
                                class="border border-gray-300 px-4 py-1 rounded-lg "
                                value="Rp {{ number_format(old("invoices.$index.amount_to_pay", 0), 0, ',', '.') }}"
                                readonly>
                            <button type="button" class="text-red-700" onclick="removeInvoiceRow(this)">
                                <svg class="h-5 w-5 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path
                                        d="M20 7V20C20 21.1046 19.1046 22 18 22H6C4.89543 22 4 21.1046 4 20V7H2V5H22V7H20ZM6 7V20H18V7H6ZM11 9H13V11H11V9ZM11 12H13V14H11V12ZM11 15H13V17H11V15ZM7 2H17V4H7V2Z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>

                <!-- Button to add a new invoice row -->
                <div class="mt-2">
                    <button type="button" class="bg-blue-500 text-white p-2 rounded-md" id="add-invoice-btn"
                        onclick="addInvoiceRow()">
                        Tambah Invoice
                    </button>
                </div>

                <!-- Total Debt Field -->
                <div class="mt-5 grid grid-cols-2 gap-4">
                    <label for="total_piutang" class="text-sm font-medium text-gray-700">Total Semua Piutang</label>
                    <input type="text" name="total_piutang" id="total_piutang"
                        class="border border-gray-300 p-2 rounded-lg w-64 h-10" placeholder="Total Piutang"
                        value="Rp {{ number_format(old('totalKeseluruhan', 0), 0, ',', '.') }}" readonly>
                </div>

                <div class="mt-5 grid grid-cols-2 gap-4">
                    <label for="nominal_dibayar" class="text-sm font-medium text-gray-700">Nominal yang Dibayar</label>
                    <input type="text" name="nominal_dibayar" id="nominal_dibayar"
                        class="border border-gray-300 p-2 rounded-lg w-64 h-10" placeholder="Nominal yang Dibayar"
                        value="{{ old('nominal_dibayar') }}" oninput="formatCurrency(this)">
                </div>
                <!-- Submit Payment Button -->
                <div class="mt-6">
                    <button type="submit" class="w-24 bg-blue-500 text-white p-2 rounded-md">Bayar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function addInvoiceRow() {
            const container = document.getElementById('invoice-container');
            const index = container.querySelectorAll('.invoice-row').length;
            const newRow = `
        <div class="grid grid-cols-8 gap-4 mb-2 invoice-row min-w-max">
            <input type="text" name="invoices[${index}][nomor_invoice]"
                class="border border-gray-300 rounded px-2 py-1 text-sm  h-10" placeholder="Nomor Invoice" required>
            <input type="text" name="invoices[${index}][nama_pelanggan]"
                class="border border-gray-300 rounded px-2 py-1 text-sm  h-10" placeholder="Nama Pelanggan" readonly>
            <input type="date" name="invoices[${index}][jatuh_tempo]"
                class="border border-gray-300 rounded px-2 py-1 text-sm  h-10" placeholder="Jatuh Tempo" readonly>
            <input type="text" name="invoices[${index}][piutang_belum_dibayar]"
                class="border border-gray-300 rounded px-4 py-1 text-sm w-48 h-10" placeholder="Piutang Belum Dibayar" readonly>
            <input type="text" name="invoices[${index}][diskon]"
                class="border border-gray-300 rounded px-4 py-1 text-sm w-48 h-10" placeholder="Diskon" readonly>
            <input type="text" name="invoices[${index}][denda]"
                class="border border-gray-300 rounded px-4 py-1 text-sm w-48 h-10" placeholder="Denda" readonly>
            <input type="text" name="invoices[${index}][amount_to_pay]"
                class="border border-gray-300 px-4 py-1 text-sm w-48 h-10 rounded-lg" placeholder="Total Piutang" readonly>
            <button type="button" class="text-red-700 w-16 h-10" onclick="removeInvoiceRow(this)">
                <svg class="h-5 w-5 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20 7V20C20 21.1046 19.1046 22 18 22H6C4.89543 22 4 21.1046 4 20V7H2V5H22V7H20ZM6 7V20H18V7H6ZM11 9H13V11H11V9ZM11 12H13V14H11V12ZM11 15H13V17H11V15ZM7 2H17V4H7V2Z"></path>
                </svg>
            </button>
        </div>
    `;
            container.insertAdjacentHTML('beforeend', newRow);
        }

        function removeInvoiceRow(button) {
            const row = button.closest('.invoice-row');
            row.remove();
        }



        document.querySelectorAll(
            'input[name$="[piutang_belum_dibayar]"], input[name$="[diskon]"], input[name$="[denda]"], input[name$="[amount_to_pay]"], input[name="nominal_dibayar"]'
        ).forEach(input => {
            input.addEventListener('input', function() {
                formatCurrency(this);
            });
        });
    </script>
@endsection
