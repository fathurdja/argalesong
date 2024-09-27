import './bootstrap';
import 'flowbite';


document.addEventListener('DOMContentLoaded', function() {
    const arrows = document.querySelectorAll('.arrow');
    const sidebar = document.querySelector('.sidebar');

    arrows.forEach(arrow => {
        arrow.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent click event from propagating to parent elements
            const submenu = this.closest('li').querySelector('.sidebar-submenu');
            submenu.classList.toggle('active');
        });
    });

    sidebar.addEventListener('mouseleave', function() {
        document.querySelectorAll('.sidebar-submenu').forEach(submenu => {
            submenu.classList.remove('active');
        });
    });
});

document.getElementById('dpp').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault(); // Mencegah pengiriman form saat Enter
        calculateTotal(); // Jalankan perhitungan
    }
});
document.getElementById('tanggal_transaksi').addEventListener('change', calculateDays);
document.getElementById('jatuh_tempo').addEventListener('change', calculateDays);

function calculateDays() {
    var tanggalTransaksi = document.getElementById('tanggal_transaksi').value;
    var jatuhTempo = document.getElementById('jatuh_tempo').value;

    if (tanggalTransaksi && jatuhTempo) {
        var startDate = new Date(tanggalTransaksi);
        var endDate = new Date(jatuhTempo);
        var timeDiff = endDate - startDate;
        var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
        document.getElementById('jarak_hari').value = daysDiff;
    } else {
        document.getElementById('jarak_hari').value = ''; // clear field if dates are not set
    }
}

function formatRupiah(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 2,
    }).format(amount);
}

function unformatRupiah(value) {
    // Remove any non-numeric characters except for commas
    return parseFloat(value.replace(/[^0-9,-]+/g, '').replace(',', '.'));
}

function formatInput(element) {
    var value = element.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
    if (value) {
        element.value = formatRupiah(parseFloat(value));
    }
}

function unformatInput(element) {
    // When focusing on the input, unformat it so user can type raw numbers
    var value = element.value.replace(/[^0-9]/g, '');
    if (value) {
        element.value = parseFloat(value); // Convert back to number for easy input
    }
}


function calculateTotal() {
    var dpp = unformatRupiah(document.getElementById('dpp').value || '0');
    var pajakPercentage = parseFloat(document.getElementById('pajak').value || 0);

    var ppnValue = (dpp * pajakPercentage) / 100;
    var totalPiutang = dpp + ppnValue;

    // Update the fields
    document.getElementById('ppn_value').value = formatRupiah(ppnValue);
    document.getElementById('total_piutang').value = formatRupiah(totalPiutang);
}

document.getElementById('dpp').addEventListener('focus', function() {
    unformatInput(this);
});

document.getElementById('dpp').addEventListener('blur', function() {
    formatInput(this);
});

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
                    <td class="px-6 py-4 whitespace-nowrap">${item.idtra}</td>
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
    fetchData(4, document.getElementById('year').value); // Example for September
});