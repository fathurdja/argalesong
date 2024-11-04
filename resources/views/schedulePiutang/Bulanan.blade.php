@extends('layouts.app')

@section('content')
    <div class="container mx-9 mt-4 p-4 rounded-lg bg-white ">
        <h1 class="text-2xl font-bold mb-4 ">SCHEDULE PIUTANG</h1>
        <!-- Year Selection -->
        <div class="flex items-center mb-4">
            <label for="year" class="mr-2 font-semibold text-gray-700">Tahun</label>
            <select id="year"
                class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="2023">2018</option>
                <option value="2023">2019</option>
                <option value="2023">2020</option>
                <option value="2023">2021</option>
                <option value="2023">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2024">2025</option>
                <option value="2024">2026</option>
                <option value="2024">2027</option>
                <option value="2024">2028</option>
                <option value="2024">2029</option>
                <option value="2024">2030</option>
                <option value="2024">2031</option>
                <option value="2024">2032</option>
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
        <div class="flex justify-end my-5">
            <button class="px-4 py-2 bg-green-600 text-white rounded-md shadow-sm hover:bg-gray-300">Cetak</button>
        </div>
    </div>
@endsection
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function formatRupiah(angka) {
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

            // Function to fetch data based on selected month and year
            function fetchData(month, year) {
                fetch(`/get-monthly-report?month=${month}&year=${year}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('report-body');
                        tbody.innerHTML = ''; // Clear current data

                        let totalSaldoPiutang = 0; // Variabel untuk menghitung total saldo piutang

                        if (data.length === 0) {
                            tbody.innerHTML =
                                `<tr><td colspan="7" class="text-center py-4 text-gray-500">Data tidak ditemukan</td></tr>`;
                        } else {
                            data.forEach((item, index) => {
                                let saldoPiutang = parseInt(item.nominal); // Pastikan ini angka
                                if (isNaN(saldoPiutang)) saldoPiutang =
                                    0; // Handle jika saldoPiutang bukan angka
                                totalSaldoPiutang += saldoPiutang; // Tambahkan ke total

                                tbody.innerHTML += `
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">${index + 1}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${item.no_invoice}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${item.pelanggan ? item.pelanggan.name : 'Tidak ada data pelanggan'}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${item.tgl_jatuh_tempo}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">${formatRupiah(item.nominal)},00</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">${formatRupiah(saldoPiutang)},00</td>
                    </tr>
                `;
                            });

                            // Tambahkan baris terakhir untuk total saldo piutang
                            tbody.innerHTML += `
                <tr>
                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-right font-bold">Total Saldo Piutang</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right font-bold">${formatRupiah(totalSaldoPiutang)},00</td>
                </tr>
            `;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        const tbody = document.getElementById('report-body');
                        tbody.innerHTML =
                            `<tr><td colspan="7" class="text-center py-4 text-red-500">Terjadi kesalahan dalam mengambil data</td></tr>`;
                    });
            }

            // Event listeners for month selection
            const today = new Date();
            const currentMonth = today.getMonth() + 1; // bulan dalam JavaScript 0-indexed, jadi tambahkan 1
            const currentYear = today.getFullYear();

            // Setel tahun sekarang di dropdown
            document.getElementById('year').value = currentYear;

            // Highlight bulan saat ini dan fetch data
            function highlightCurrentMonth(month) {
                document.querySelectorAll('[id^="month-"]').forEach(el => el.classList.remove(
                    'border-b-4', 'border-indigo-600', 'font-bold'));
                document.getElementById(`month-${month}`).classList.add('border-b-4', 'border-indigo-600',
                    'font-bold');
            }

            // Fetch data berdasarkan bulan dan tahun saat ini
            fetchData(currentMonth, currentYear);
            highlightCurrentMonth(currentMonth);

            // Event listeners for month selection
            document.querySelectorAll('[id^="month-"]').forEach(element => {
                element.addEventListener('click', function() {
                    const month = this.id.split('-')[1];
                    const year = document.getElementById('year').value;

                    // Fetch and display data
                    fetchData(month, year);

                    // Highlight the selected month
                    highlightCurrentMonth(month);
                });
            });
        });
    </script>
@endpush
