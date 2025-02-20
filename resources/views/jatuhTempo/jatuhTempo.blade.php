@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-14 m-10 lg:p-10 p-2 rounded-lg bg-white">
        <h1 class="text-2xl font-bold ">JATUH TEMPO</h1>

@php
    $startYear = 2020;
    $endYear = date('Y'); // Tahun saat ini
    $currentYear = date('Y'); // Tahun saat ini untuk default
    $currentMonth = date('n'); // Bulan saat ini (angka 1-12)

    $months = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
@endphp


<div>
    <div class="flex justify-start mb-4 lg:mt-4 mt-4 w-full flex-col sm:flex-col gap-2 sm:gap-10 px-2 py-1 sm:p-4">

         <!-- Pilihan Tahun -->
         <div class="flex gap-5">
            <div class="flex items-center">
                <label for="tahun" class="mr-2 text-sm font-medium text-gray-700">Tahun</label>
                <select id="tahun" name="tahun" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 sm:text-sm rounded-md">
                    @for ($year = $startYear; $year <= $endYear; $year++)
                        <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
            </div>
             <!-- Pilihan Bulan -->
             <div class="flex items-center">
                <label for="bulan" class="mr-2 text-sm font-medium text-gray-700">Bulan</label>
                <select id="bulan" name="bulan" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 sm:text-sm rounded-md">
                    @foreach ($months as $index => $bulan)
                        @if ($index + 1 <= $currentMonth || request('tahun') < $endYear)
                            <option value="{{ $index + 1 }}" {{ ($index + 1) == $currentMonth ? 'selected' : '' }}>
                                {{ $bulan }}
                            </option>
                        @endif
                    @endforeach
                </select>
             </div>
         </div>
        <!-- Table for Laptop (Desktop View) -->
        <div class="hidden lg:block bg-white shadow-md rounded-lg lg:p-6">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No Invoice</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode Perusahaan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl Invoice</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl Jatuh Tempo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Piutang Belum Dibayar</th>
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

@vite('resources/js/jatuh-tempo.js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function fetchData(month, year) {
            fetch(`/jatuh-tempo/data/${year}/${month}`)
                .then(response => response.json())
                .then(data => {
                    const tbodyLaptop = document.getElementById('report-body-laptop');
                    const tbodyMobile = document.getElementById('report-body-mobile');
                    tbodyLaptop.innerHTML = '';
                    tbodyMobile.innerHTML = '';

                        if (data.length === 0) {
                            tbodyLaptop.innerHTML = tbodyMobile.innerHTML = '<div class="text-center py-4 text-gray-500">Data tidak ditemukan</div>';
                        } else {
                            data.forEach (pelanggan => {
                                // For laptop/tablet display (Full Table)
                                tbodyLaptop.innerHTML += `
                                    <tr>
                                        <td class="px-2 md:px-6 py-4">${index + 1}</td>
                                        <td class="px-2 md:px-6 py-4">${pelanggan.no_invoice}</td>
                                        <td class="px-2 md:px-6 py-4">${pelanggan.kode_perusahaan}</td>
                                        <td class="px-2 md:px-6 py-4">${pelanggan.nama_pelanggan}</td>
                                        <td class="px-2 md:px-6 py-4">${pelanggan.tgl_invoice}</td>
                                        <td class="px-2 md:px-6 py-4">${pelanggan.tgl_jatuh_tempo}</td>
                                        <td class="px-2 md:px-6 py-4 text-right">${pelanggan.piutang_belum_dibayar}</td>
                                    </tr>`;

                                // For mobile display (Simplified View)
                                tbodyMobile.innerHTML += `
                                    <div class="flex justify-between text-sm py-3 px-4">
                                        <div class="flex-1 font-bold">${pelanggan.nama_pelanggan}</div>
                                        <div class="flex-1 text-right">${pelanggan.piutang_belum_dibayar}</div>
                                    </div>
                                    <div class="flex justify-between text-xs py-1 px-4">
                                        <div class="flex-1">${pelanggan.tgl_jatuh_tempo}</div>
                                        <div class="flex-1 text-right">No Invoice : ${pelanggan.no_invoice}</div>
                                    </div>
                                    <div class="text-right px-4 py-2">
                                        <a href="/jatuh-tempo/detail/${pelanggan.id}" class="text-blue-600">
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
        document.getElementById('tahun').value = currentYear;
        fetchData(currentMonth, currentYear);

        document.querySelectorAll('[id^="month-"]').forEach(element => {
            element.addEventListener('click', function() {
                const month = this.id.split('-')[1];
                const year = document.getElementById('tahun').value;
                fetchData(month, year);
            });
        });

            // Listen for year and month changes
            document.getElementById('tahun').addEventListener('change', function() {
                fetchData(currentMonth, this.value);
            });
    
    tahunSelect.addEventListener("change", getData);
    bulanSelect.addEventListener("change", getData);

    getData(); 
});
</script>
@endpush