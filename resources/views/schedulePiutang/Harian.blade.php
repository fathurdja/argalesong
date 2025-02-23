@extends('layouts.app')

@php
    $currentYear = date('Y');
    $currentMonth = date('n');
    $currentDay = date('j'); 
@endphp

@section('content')
<div class="bg-white p-4 rounded-lg shadow-lg px-2 mt-10 lg:mt-20">
    <h1 class="text-2xl font-bold mb-4">SCHEDULE PIUTANG</h1>

    <!-- Year and Month Selection -->
    <div class="lg:flex items-center mb-4 md:w-max-screen overflow-x-auto lg:flex-wrap">
        <label for="year" class="mr-2 font-semibold text-gray-700">Tahun</label>
        <select id="year" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @foreach (range(2020, $currentYear) as $year) {{-- Menggunakan tahun dinamis --}}
                <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>

        <label for="month" class=" font-semibold text-gray-700">Bulan</label>
        <select id="month" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm overflow-x-auto">
            @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $key => $month)
                <option value="{{ $key + 1 }}" {{ ($key + 1) == $currentMonth ? 'selected' : '' }}>
                    {{ $month }}
                </option>
            @endforeach
        </select>

        <label for="day" class=" font-semibold text-gray-700">Hari</label>
        <select id="day" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @foreach (range(1, 31) as $day)
                <option value="{{ $day }}" {{ $day == $currentDay ? 'selected' : '' }}>
                    {{ $day }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Invoice Table laptop-->
    <div class=" bg-white shadow-md rounded-lg md:p-6 p-2 overflow-auto w-full">
        <table class=" hidden md:block">
            <thead class="bg-gray-50">
                <tr>
                    <th class="md:px-6 px-2 md:py-3 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="md:px-6 px-2 md:py-3 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelanggan</th>
                    <th class="md:px-6 px-2 md:py-3 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo Piutang</th>
                    <th class="md:px-6 px-2 md:py-3 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Kode</th>
                    <th class="md:px-6 px-2 md:py-3 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Jatuh Tempo</th>
                    <th class="md:px-6 px-2 md:py-3 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Total Piutang</th>
                    <th class="md:px-6 px-2 md:py-3 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Pembayaran</th>
                    <th class="md:px-6 px-2 md:py-3 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider md:hidden">Aksi</th>
                </tr>
            </thead>
            <tbody id="report-body" class="bg-white divide-y divide-gray-200 text-sm ">
                <!-- Data will be populated via JavaScript -->
            </tbody>
        </table>
    </div>
    <!-- Table for Mobile & Tablet (Mobile View) -->
    <div class="md:hidden bg-white shadow-md rounded-lg lg:p-6 overflow-auto">
        <div class="space-y-4">
            <div class="flex justify-between text-sm font-semibold py-2 px-4 bg-gray-50">
                <div class="flex-1 text-left">Transaksi</div>
                <div class="flex-1 text-right">Jumlah</div>
            </div>
            <div id="mobile-body" class="bg-white divide-y md:hidden divide-gray-200 text-sm p-4">
               <!-- Data will be populated via JavaScript mobile-->
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
    document.getElementById('year').addEventListener('change', fetchData);
    document.getElementById('month').addEventListener('change', fetchData);
    document.getElementById('day').addEventListener('change', fetchData);

    function formatRupiah(angka) {
        if (angka === undefined || angka === null || isNaN(angka)) {
            return 'Rp. 0';
        }
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
            const mobileBody = document.getElementById('mobile-body');

            // Bersihkan data sebelum menambahkan yang baru
            reportBody.innerHTML = '';
            mobileBody.innerHTML = '';

            if (data.length === 0) {
                reportBody.innerHTML = '<tr><td colspan="8" class="text-center px-6 py-3">No data available</td></tr>';
                mobileBody.innerHTML = '<div class="text-center py-4 text-gray-500">No data available</div>';
                return;
            }

            data.forEach((item, index) => {
                // Data untuk tampilan desktop
                // const rowReport = `<tr onclick="window.location.href='sp-harian/detail/${item.id_pelanggan}'">
                const rowReport = `<tr >
                    <td class="md:px-6 px-2 md:py-3 py-4">${index + 1}</td>
                    <td class="md:px-6 px-2 md:py-3 py-4">${item.pelanggan}</td>
                    <td class="md:px-6 px-2 md:py-3 py-4 text-right">${formatRupiah(item.saldo_piutang)}</td>
                    <td class="md:px-6 px-2 md:py-3 py-4 hidden md:table-cell">${item.kodepiutang}</td>
                    <td class="md:px-6 px-2 md:py-3 py-4 hidden md:table-cell">${item.jatuh_tempo}</td>
                    <td class="md:px-6 px-2 md:py-3 py-4 text-right hidden md:table-cell">${formatRupiah(item.total_piutang)}</td>
                    <td class="md:px-6 px-2 md:py-3 py-4 text-right hidden md:table-cell">${formatRupiah(item.total_pembayaran)}</td>
                    <td class="md:px-6 px-2 md:py-3 py-4 text-center md:hidden">
                        <a href="/report-detail/${item.kodepiutang}" class="text-blue-500">Detail</a>
                    </td>
                </tr>`;

                // Data untuk tampilan mobile
                const rowMobile = `<div>
                    <a href="sp-harian/detail/${item.id_pelanggan}" class="block text-slate-800">
                        <div class="flex justify-between py-2">
                            <span class="font-bold">${item.pelanggan}</span>
                            <span class="text-right font-semibold">${formatRupiah(item.saldo_piutang)}</span>
                        </div>
                        <div class="text-gray-600 flex justify-between items-center flex-wrap gap-2">
                            <div>${item.jatuh_tempo}</div>
                            <div>Pembayaran: ${formatRupiah(item.total_pembayaran)}</div>
                        </div>
                            <div class="font-bold"></div>
                            <div class="font-bold">Total Piutang : ${formatRupiah(item.total_piutang)}</div>
                        <div class="text-right text-blue-500 font-medium mt-2">Selengkapnya</div>
                    </a>
                </div>`;

                reportBody.innerHTML += rowReport;
                mobileBody.innerHTML += rowMobile;
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            document.getElementById('mobile-body').innerHTML = '<div class="text-center py-4 text-red-500">Gagal mengambil data</div>';
        });
}

</script>
@endpush