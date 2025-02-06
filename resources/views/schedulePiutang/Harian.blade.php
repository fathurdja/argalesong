@extends('layouts.app')

@php
    $currentYear = date('Y');
    $currentMonth = date('n');
    $currentDay = date('j'); 
@endphp

@section('content')
<div class="bg-white p-4 rounded-lg shadow-lg mt-4 ml-9">
    <h1 class="text-2xl font-bold mb-4">SCHEDULE PIUTANG</h1>

    <!-- Year and Month Selection -->
    <div class="flex items-center mb-4 md:w-max-screen">
        <label for="year" class="mr-2 font-semibold text-gray-700">Tahun</label>
        <select id="year" 
            class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @foreach (range(2010, 2032) as $year)
                <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>

        <label for="month" class="ml-4 mr-2 font-semibold text-gray-700">Bulan</label>
        <select id="month"
            class="border-gray-300 sm:overflow-scroll rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $key => $month)
                <option value="{{ $key + 1 }}" {{ ($key + 1) == $currentMonth ? 'selected' : '' }}>
                    {{ $month }}
                </option>
            @endforeach
        </select>

        <label for="day" class="ml-4 mr-2 font-semibold text-gray-700">Hari</label>
        <select id="day"
            class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @foreach (range(1, 31) as $day)
                <option value="{{ $day }}" {{ $day == $currentDay ? 'selected' : '' }}>
                    {{ $day }}
                </option>
            @endforeach
        </select>
    </div>

        <!-- Invoice Table -->
        <div class="bg-white shadow-md rounded-lg p-6 overflow-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jatuh
                            Tempo</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total
                            Piutang</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pembayaran</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo
                            Piutang</th>
                    </tr>
                </thead>
                <tbody id="report-body" class="bg-white divide-y divide-gray-200 text-sm">
                    <!-- Data will be populated via JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Print Button -->
        <div class="flex justify-end mt-6">
            <button id="print-btn" onclick="window.print()"
                class="active:scale-[.95] hover:bg-white hover:text-[#0F8114] transition-all text-white font-medium border-2 border-[#0F8114] rounded-md shadow-sm px-4 py-1 bg-[#0F8114]">Cetak</button>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.getElementById('year').addEventListener('change', fetchData);
        document.getElementById('month').addEventListener('change', fetchData);
        document.getElementById('day').addEventListener('change', fetchData);

        // Format Rupiah
        function formatRupiah(angka) {
            if (angka === undefined || angka === null || isNaN(angka)) {
                return 'Rp. 0'; // Atau nilai default lainnya jika angka null atau undefined
            }
            // Pastikan angka adalah integer, hilangkan desimal jika ada
            angka = Math.floor(angka);

            let number_string = angka.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return 'Rp. ' + rupiah;
        }

        function fetchData() {
            const year = document.getElementById('year').value;
            const month = document.getElementById('month').value;
            const day = document.getElementById('day').value;

            fetch(`/daily-report?year=${year}&month=${month}&day=${day}`)
                .then(response => response.json())
                .then(data => {
                    const reportBody = document.getElementById('report-body');
                    reportBody.innerHTML = '';

                    if (data.length === 0) {
                        reportBody.innerHTML =
                            '<tr><td colspan="7" class="text-center px-6 py-3">No data available</td></tr>';
                        return;
                    }

                    data.forEach((item, index) => {
                        const row = `<tr>
                        <td class="px-6 py-3">${index + 1}</td>
                        <td class="px-6 py-3">${item.kodepiutang}</td>
                        <td class="px-6 py-3">${item.pelanggan}</td>
                        <td class="px-6 py-3">${item.jatuh_tempo}</td>
                        <td class="px-6 py-3 text-right">${formatRupiah(item.total_piutang)}</td>
                        <td class="px-6 py-3 text-right">${formatRupiah(item.total_pembayaran)}</td>
                        <td class="px-6 py-3 text-right">${formatRupiah(item.saldo_piutang)}</td>
                    </tr>`;
                        reportBody.innerHTML += row;
                    });
                });
        }

        // Initial load
        fetchData();
    </script>
@endpush