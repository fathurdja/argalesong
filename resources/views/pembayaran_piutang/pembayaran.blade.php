@extends('layouts.app')
@section('content')
    <div class="bg-white shadow-md rounded-lg overflow-hidden ml-9">
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p class="font-bold">Error!</p>
                <p>{{ $errors->first() }}</p>
            </div>
        @endif

        <div class="p-6 ml-4">
            <h1 class="text-2xl font-bold mb-6 ">PEMBAYARAN PIUTANG</h1>
            <form method="POST" action="{{ route('pembayaran-piutang.proses') }}" id="paymentForm"
                data-proses-url="{{ route('pembayaran-piutang.proses') }}"
                data-store-url="{{ route('pembayaran-piutang.store') }}">
                @csrf
                <input type="hidden" name="_method" value="POST">

                <div class="flex items-end gap-3 mb-4">
                    <div class="">
                        <label for="tanggal_transaksi" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                            Transaksi</label>
                        <input type="date" name="tanggal_transaksi" id="tanggal_transaksi"
                            value="{{ old('tanggal_transaksi', now()->format('Y-m-d')) }}"
                            class="w-64 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class= "mb-1">
                        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
                            id="add-invoice-btn" onclick="addInvoiceRow()">
                            Tambah Invoice
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto mb-4">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nomor Invoice</th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Pelanggan</th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jatuh Tempo</th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Piutang</th>
                                <th
                                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">
                                    Diskon</th>
                                <th
                                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">
                                    Denda</th>
                                <th
                                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">
                                    Total Piutang</th>
                                <th class="px-3 py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="invoice-container">
                            @foreach (old('invoices', [0]) as $index => $invoice)
                                <tr class="invoice-row">
                                    <td class="px-3 py-2">
                                        <input type="text" name="invoices[{{ $index }}][nomor_invoice]"
                                            class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full"
                                            placeholder="Nomor Invoice" value="{{ old("invoices.$index.nomor_invoice") }}"
                                            onkeydown="handleEnter(event, 'proses')" required>
                                    </td>
                                    <td class="px-3 py-2">
                                        <input type="text" name="invoices[{{ $index }}][nama_pelanggan]"
                                            class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full"
                                            placeholder="Nama Pelanggan" value="{{ old("invoices.$index.nama_pelanggan") }}"
                                            readonly>
                                        <input type="hidden" name="invoices[{{ $index }}][idpelanggan]"
                                            value="{{ old("invoices.$index.idpelanggan") }}">
                                    </td>
                                    <td class="px-3 py-2">
                                        <input type="date" name="invoices[{{ $index }}][jatuh_tempo]"
                                            class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full"
                                            value="{{ old("invoices.$index.jatuh_tempo") }}" readonly>
                                    </td>
                                    <td class="px-4 py-2">
                                        <input type="text" name="invoices[{{ $index }}][piutang_belum_dibayar]"
                                            class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full"
                                            value="Rp {{ number_format((float) old("invoices.$index.piutang_belum_dibayar", 0), 0, ',', '.') }}"
                                            readonly>
                                    </td>
                                    <td class="px-4 py-2">
                                        <input type="text"
                                            class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full text-base font-medium"
                                            value="Rp {{ number_format((float) old("invoices.$index.diskon", 0), 0, ',', '.') }}"
                                            readonly>
                                        <input type="hidden" name="invoices[{{ $index }}][diskon]"
                                            value="{{ old("invoices.$index.diskon", 0) }}">
                                    </td>
                                    <td class="px-4 py-2">
                                        <input type="text"
                                            class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full text-base font-medium"
                                            value="Rp {{ number_format((float) old("invoices.$index.denda", 0), 0, ',', '.') }}"
                                            readonly>
                                        <input type="hidden" name="invoices[{{ $index }}][denda]"
                                            value="{{ old("invoices.$index.denda", 0) }}">
                                    </td>
                                    <td class="px-3 py-2">
                                        <input type="text" name="invoices[{{ $index }}][amount_to_pay]"
                                            class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full text-base font-medium"
                                            value="Rp {{ number_format((float) old("invoices.$index.amount_to_pay", 0), 0, ',', '.') }}"
                                            readonly>
                                    </td>
                                    <td class="px-3 py-2">
                                        <button type="button" class="text-red-600 hover:text-red-800"
                                            onclick="removeInvoiceRow(this)">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mb-4">

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="mode_bayar" class="block text-sm font-medium text-gray-700 mb-1">Mode Bayar</label>
                        <select id="mode_bayar" name="mode_bayar"
                            class="w-full p-2 bg-white border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="KAS">KAS</option>
                            <option value="BANK">BANK</option>
                        </select>
                    </div>
                    <div>
                        <label for="total_piutang" class="block text-sm font-medium text-gray-700 mb-1">Total Semua
                            Piutang</label>
                        <input type="text" name="total_piutang" id="total_piutang"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-lg font-bold"
                            placeholder="Total Piutang"
                            value="Rp {{ number_format(old('totalKeseluruhan', 0), 0, ',', '.') }}" readonly>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="nominal_dibayar" class="block text-sm font-medium text-gray-700 mb-1">Nominal yang
                        Dibayar</label>
                    <input type="text" id="nominalDibayarDisplay"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-lg font-bold"
                        placeholder="Nominal yang Dibayar">
                    <input type="number" name="nominal_dibayar" id="nominalDibayar" class="hidden"
                        value="{{ old('nominal_dibayar') }}">
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="submitForm('proses')"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 hidden">Proses</button>
                    <button type="button" onclick="submitForm('store')"
                        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Bayar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
