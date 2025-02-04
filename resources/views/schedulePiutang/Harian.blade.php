@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 rounded-lg shadow-lg mt-4 ml-9">
        <h1 class="text-2xl font-bold mb-4">SCHEDULE PIUTANG</h1>

        <!-- Year and Month Selection -->
        <div class="flex items-center mb-4">
            <label for="year" class="mr-2 font-semibold text-gray-700">Tahun</label>
            <select id="year"
                class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @foreach (range(2010, 2032) as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>

            <label for="month" class="ml-4 mr-2 font-semibold text-gray-700">Bulan</label>
            <select id="month" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $key => $month)
                    <option value="{{ $key + 1 }}">{{ $month }}</option>
                @endforeach
            </select>

            <label for="day" class="ml-4 mr-2 font-semibold text-gray-700">Hari</label>
            <select id="day" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @foreach (range(1, 31) as $day)
                    <option value="{{ $day }}">{{ $day }}</option>
                @endforeach
            </select>
        </div>

        <!-- Invoice Table -->
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
                    <!-- Data will be populated via JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Print Button -->
        <div class="flex justify-end mt-6">
            <button id="print-btn" onclick="window.print()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md shadow-sm hover:bg-gray-300">Cetak</button>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.getElementById('year').addEventListener('change', fetchData);
        document.getElementById('month').addEventListener('change', fetchData);
        document.getElementById('day').addEventListener('change', fetchData);

        function fetchData() {
            const year = document.getElementById('year').value;
            const month = document.getElementById('month').value;
            const day = document.getElementById('day').value;

            fetch(`/api/daily-report?year=${year}&month=${month}&day=${day}`)

                .then(response => response.json())
                .then(data => {
                    const reportBody = document.getElementById('report-body');
                    reportBody.innerHTML = '';

                    if (data.length === 0) {
                        reportBody.innerHTML = '<tr><td colspan="7" class="text-center px-6 py-3">No data available</td></tr>';
                        return;
                    }

                    data.forEach((item, index) => {
                        const row = `<tr>
                            <td class="px-6 py-3">${index + 1}</td>
                            <td class="px-6 py-3">${item.kodepiutang}</td>
                            <td class="px-6 py-3">${item.pelanggan}</td>
                            <td class="px-6 py-3">${item.jatuh_tempo}</td>
                            <td class="px-6 py-3 text-right">${item.total_piutang}</td>
                            <td class="px-6 py-3 text-right">${item.total_pembayaran}</td>
                            <td class="px-6 py-3 text-right">${item.saldo_piutang}</td>
                        </tr>`;
                        reportBody.innerHTML += row;
                    });
                });
        }

        // Initial load
        fetchData();
    </script>
@endpush
