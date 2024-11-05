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

                    <!-- Dropdown Pelanggan -->
                    <div class="mb-1">
                        <label for="customer" class="block text-sm font-medium text-gray-700 mb-1">Pilih Pelanggan</label>
                        <select name="customer" id="customer"
                            class="w-64 border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            onchange="loadInvoicesByCustomer(this.value)">
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id_Pelanggan }}"
                                    {{ $selectedCustomerId == $customer->id_Pelanggan ? 'selected' : '' }}>
                                    {{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="overflow-x-auto mb-4">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nomor Invoice</th>

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
                            <!-- Rows will be dynamically populated -->
                        </tbody>
                    </table>
                </div>

                <!-- Fields for Total Piutang and Payment -->
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
                        <input type="text" name="total_piutang" id="total-piutang"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-lg font-bold"
                            placeholder="Total Piutang" readonly>
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
@push('script')
    <script>
        // Pertama, ubah fungsi loadInvoicesByCustomer untuk memperbaiki indeks setelah penghapusan
        function loadInvoicesByCustomer(customerId) {
            const invoiceContainer = document.getElementById('invoice-container');
            invoiceContainer.innerHTML = '';

            if (!customerId) return;

            fetch(`/api/invoices-by-customer/${customerId}`)
                .then(response => response.json())
                .then(data => {
                    let totalPiutang = 0;

                    data.invoices.forEach((invoice, index) => {
                        totalPiutang += parseFloat(invoice.total);

                        const row = `
                <tr class="invoice-row" data-total="${invoice.total}">
                    <td class="px-3 py-2">
                        <input type="text" name="invoices[${index}][nomor_invoice]"
                            class="invoice-input border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full"
                            value="${invoice.no_invoice}" readonly>
                    </td>
                    <td class="px-3 py-2">
                        <input type="date" name="invoices[${index}][jatuh_tempo]"
                            class="invoice-input border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full"
                            value="${invoice.tgl_jatuh_tempo}" readonly>
                    </td>
                    <td class="px-3 py-2">
                        <input type="text"
                            class="piutang-input border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full"
                            value="Rp ${parseFloat(invoice.nominal).toLocaleString()}"
                            onchange="updateRowTotal(this)">
                        <input type="hidden" name="invoices[${index}][piutang_belum_dibayar]" class="piutang-value" value="${invoice.nominal}">
                        <input type="hidden" name="invoices[${index}][original_piutang]" value="${invoice.nominal}">
                    </td>
                    <td class="px-3 py-2">
                        <input type="text"
                            class="diskon-input border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full"
                            value="Rp ${parseFloat(invoice.diskon).toLocaleString()}" 
                            onchange="updateRowTotal(this)">
                        <input type="hidden" name="invoices[${index}][diskon]" class="diskon-value" value="${invoice.diskon}">
                    </td>
                    <td class="px-3 py-2">
                        <input type="text"
                            class="denda-input border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full"
                            value="Rp ${parseFloat(invoice.denda).toLocaleString()}"
                            onchange="updateRowTotal(this)">
                        <input type="hidden" name="invoices[${index}][denda]" class="denda-value" value="${invoice.denda}">
                        <input type="hidden" name="invoices[${index}][original_denda]" value="${invoice.denda}">
                    </td>
                    <td class="px-3 py-2">
                        <input type="text"
                            class="total-display border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full"
                            value="Rp ${parseFloat(invoice.total).toLocaleString()}" readonly>
                        <input type="hidden" name="invoices[${index}][total]" class="total-value" value="${invoice.total}">
                    </td>
                    <td class="px-3 py-2">
                        <button type="button" class="delete-btn" data-total="${invoice.total}">
                            <svg class="h-5 w-5 fill-red-600" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </td>
                </tr>`;

                        invoiceContainer.insertAdjacentHTML('beforeend', row);
                    });

                    // Add event listeners for input formatting
                    document.querySelectorAll('.piutang-input, .denda-input, .diskon-input').forEach(input => {
                        input.addEventListener('focus', function() {
                            // Remove formatting when focused
                            this.value = this.value.replace(/[^0-9.-]+/g, "");
                        });

                        input.addEventListener('blur', function() {
                            // Format number when leaving the input
                            const value = parseFloat(this.value) || 0;
                            this.value = `Rp ${value.toLocaleString()}`;

                            // Update the hidden value
                            const hiddenInput = this.nextElementSibling;
                            hiddenInput.value = value;

                            updateRowTotal(this);
                        });

                        // Add keyup event for real-time updates while typing
                        input.addEventListener('keyup', function(e) {
                            // Only allow numbers and decimal point
                            if (!/^\d*\.?\d*$/.test(this.value)) {
                                this.value = this.value.replace(/[^\d.]/g, '');
                            }
                        });
                    });

                    updateTotalPiutang();

                    // Event listener untuk tombol delete
                    document.querySelectorAll('.delete-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            const row = this.closest('tr');
                            row.remove();
                            reindexInvoiceInputs();
                            updateTotalPiutang();
                        });
                    });
                });
        }

        function formatRupiah(number) {
            return `Rp ${parseFloat(number).toLocaleString()}`;
        }

        function unformatRupiah(rupiahString) {
            return parseFloat(rupiahString.replace(/[^0-9.-]+/g, "")) || 0;
        }

        function updateRowTotal(input) {
            const row = input.closest('tr');
            const piutangValue = parseFloat(row.querySelector('.piutang-value').value) || 0;
            const diskonValue = parseFloat(row.querySelector('.diskon-value').value) || 0;
            const dendaValue = parseFloat(row.querySelector('.denda-value').value) || 0;

            // Calculate new total
            const newTotal = piutangValue - diskonValue + dendaValue;

            // Update total display and value
            const totalDisplay = row.querySelector('.total-display');
            const totalValue = row.querySelector('.total-value');

            totalDisplay.value = formatRupiah(newTotal);
            totalValue.value = newTotal;

            // Update grand total
            updateTotalPiutang();
        }

        function updateTotalPiutang() {
            let total = 0;
            document.querySelectorAll('.total-value').forEach(input => {
                total += parseFloat(input.value) || 0;
            });

            document.getElementById('total-piutang').value = formatRupiah(total);
        }

        function reindexInvoiceInputs() {
            const rows = document.querySelectorAll('.invoice-row');
            rows.forEach((row, index) => {
                const inputs = row.querySelectorAll('input[name^="invoices["]');
                inputs.forEach(input => {
                    const oldName = input.name;
                    const fieldName = oldName.match(/\[([^\]]+)\]$/)[1];
                    input.name = `invoices[${index}][${fieldName}]`;
                });
            });
        }

        function submitForm(action) {
            const form = document.getElementById('paymentForm');
            if (action === 'proses') {
                form.action = form.dataset.prosesUrl;
            } else {
                form.action = form.dataset.storeUrl;
            }
            form.submit();
        }
    </script>
@endpush
