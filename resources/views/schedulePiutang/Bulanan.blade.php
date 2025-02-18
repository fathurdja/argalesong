@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-20 m-10 p-4 rounded-lg bg-white ">
        <h1 class="text-2xl font-bold mb-4">SCHEDULE PIUTANG</h1>

        <!-- Year Selection -->
        <div class="flex items-center mb-4">
            <label for="year" class="mr-2 font-semibold text-gray-700">Tahun</label>
            <select id="year" 
                class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @foreach (range(2010, 2032) as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>

        <!-- Month Tabs -->
        <div class="flex justify-between mb-4 border-b-2 border-gray-200 overflow-auto">
            @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $key => $month)
                <div id="month-{{ $key + 1 }}" class="py-2 px-4 cursor-pointer text-gray-700 hover:text-black">
                    {{ $month }}
                </div>
            @endforeach
        </div>

        <!-- Table for Laptop (Desktop View) -->
        <div class="hidden lg:block bg-white shadow-md rounded-lg lg:p-6">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jatuh Tempo</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total Piutang</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Pembayaran</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Saldo Piutang</th>
                    </tr>
                </thead>
                <tbody id="report-body-laptop" class="bg-white divide-y divide-gray-200 text-sm">
                    <!-- Data will be populated via JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Table for Mobile & Tablet (Mobile View) -->
        <div class="lg:hidden bg-white shadow-md rounded-lg lg:p-6 overflow-auto">
            <div class="space-y-4">
                <div class="flex justify-between text-sm font-semibold py-2 px-4 bg-gray-50">
                    <div class="flex-1 text-left">Transaksi</div>
                    <div class="flex-1 text-right">Jumlah</div>
                </div>
                <div id="report-body-mobile" class="bg-white divide-y divide-gray-200 text-sm">
                    <!-- Data will be populated via JavaScript -->
                </div>
            </div>
        </div>

        <!-- Print Button -->
        <div class="flex justify-end mt-6">
            <button id="print-btn" onclick="window.print()" class="active:scale-[.95] hover:bg-white hover:text-[#0F8114] transition-all text-white font-medium border-2 border-[#0F8114] rounded-md shadow-sm px-4 py-1 bg-[#0F8114]">Cetak</button>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function fetchData(month, year) {
                fetch(`/get-monthly-report?month=${month}&year=${year}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbodyLaptop = document.getElementById('report-body-laptop');
                        const tbodyMobile = document.getElementById('report-body-mobile');
                        tbodyLaptop.innerHTML = '';
                        tbodyMobile.innerHTML = '';

                        if (data.length === 0) {
                            tbodyLaptop.innerHTML = tbodyMobile.innerHTML = '<div class="text-center py-4 text-gray-500">Data tidak ditemukan</div>';
                        } else {
                            data.forEach((item, index) => {
                                // For laptop/tablet display (Full Table)
                                tbodyLaptop.innerHTML += `
                                    <tr>
                                        <td class="px-2 md:px-6 py-4">${index + 1}</td>
                                        <td class="px-2 md:px-6 py-4">${item.id_pelanggan}</td>
                                        <td class="px-2 md:px-6 py-4">${item.pelanggan}</td>
                                        <td class="px-2 md:px-6 py-4">${item.jatuh_tempo}</td>
                                        <td class="px-2 md:px-6 py-4 text-right">${item.total_piutang}</td>
                                        <td class="px-2 md:px-6 py-4 text-right">${item.total_pembayaran}</td>
                                        <td class="px-2 md:px-6 py-4 text-right">${item.saldo_piutang}</td>
                                    </tr>`;


                                // For mobile display (Simplified View)
                                tbodyMobile.innerHTML += `
                                    <div class="flex justify-between text-sm py-3 px-4">
                                        <div class="flex-1 font-bold">${item.pelanggan}</div>
                                        <div class="flex-1 text-right">${item.saldo_piutang}</div>
                                    </div>
                                    <div class="flex justify-between text-xs py-1 px-4">
                                        <div class="flex-1">${item.jatuh_tempo}</div>
                                        <div class="flex-1 text-right">Pembayaran : ${item.total_pembayaran}</div>
                                    </div>
                                    <div class="flex justify-between text-xs py-1 px-4">
                                        <div class="flex-1 font-bold">Saldo Piutang</div>
                                        <div class="flex-1 text-right">${item.total_piutang}</div>
                                    </div>
                                    <div class="text-right px-4 py-2">
                                        <a href="/detail/${item.id_pelanggan}" class="text-blue-600">
                                            <span class="font-medium">Selengkapnya</span>
                                        </a>
                                    </div>
                                `;
                            });
                        }
                    });
            }

            const currentMonth = new Date().getMonth() + 1;
            const currentYear = new Date().getFullYear();
            document.getElementById('year').value = currentYear;
            fetchData(currentMonth, currentYear);

            document.querySelectorAll('[id^="month-"]').forEach(element => {
                element.addEventListener('click', function() {
                    const month = this.id.split('-')[1];
                    const year = document.getElementById('year').value;
                    fetchData(month, year);
                });
            });
        });
    </script>
@endpush