@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <!-- Year Selection -->
        <div class="flex items-center mb-4">
            <label for="year" class="mr-2 font-semibold text-gray-700">Tahun</label>
            <select id="year"
                class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <!-- Add more years as needed -->
            </select>
        </div>

        <!-- Month Tabs -->
        <div class="flex justify-between mb-4 border-b-2 border-gray-200">
            @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $key => $month)
                <div id="month-{{ $key + 1 }}" class="py-2 px-4 cursor-pointer text-gray-700 hover:text-black">
                    {{ $month }}
                </div>
            @endforeach
        </div>

        <!-- Monthly Report Table -->
        <div class="bg-white shadow-md rounded-lg p-6">
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
                    <!-- This will be populated via JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Print Button -->
        <div class="flex justify-end mt-6">
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md shadow-sm hover:bg-gray-300">Cetak</button>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to fetch data based on selected month and year
            function fetchData(month, year) {
                fetch(`/get-monthly-report?month=${month}&year=${year}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('report-body');
                        tbody.innerHTML = ''; // Clear current data

                        if (data.length === 0) {
                            // If no data found
                            tbody.innerHTML =
                                `<tr><td colspan="7" class="text-center py-4 text-gray-500">Data tidak ditemukan</td></tr>`;
                        } else {
                            // Populate data
                            data.forEach((item, index) => {
                                tbody.innerHTML += `
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">${index + 1}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">${item.kode}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">${item.nama_pelanggan}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">${item.jatuh_tempo}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">${item.total_piutang}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">${item.pembayaran}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">${item.saldo_piutang}</td>
                                </tr>
                            `;
                            });
                        }
                    });
            }

            // Event listeners for month selection
            document.querySelectorAll('[id^="month-"]').forEach(element => {
                element.addEventListener('click', function() {
                    const month = this.id.split('-')[1];
                    const year = document.getElementById('year').value;

                    // Fetch and display data
                    fetchData(month, year);

                    // Highlight the selected month
                    document.querySelectorAll('[id^="month-"]').forEach(el => el.classList.remove(
                        'border-b-4', 'border-indigo-600', 'font-bold'));
                    this.classList.add('border-b-4', 'border-indigo-600', 'font-bold');
                });
            });

            // Initial fetch for default month and year (e.g., April 2023)
            fetchData(4, document.getElementById('year').value);
        });
    </script>
@endsection
