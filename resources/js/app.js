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
    const dppInput = document.getElementById('dpp');
            const ppnValueInput = document.getElementById('ppn_value');
            const totalPiutangInput = document.getElementById('total_piutang');
            const taxCheckboxes = document.querySelectorAll('input[name="pajak[]"]');
            const tanggalTransaksiInput = document.getElementById('tanggal_transaksi');
            const jatuhTempoInput = document.getElementById('jatuh_tempo');
            const jarakHariInput = document.getElementById('jarak_hari');
            function updateJarakHari() {
                const tanggalTransaksi = new Date(tanggalTransaksiInput.value);
                const jatuhTempo = new Date(jatuhTempoInput.value);

                if (tanggalTransaksi && jatuhTempo) {
                    const diffTime = Math.abs(jatuhTempo - tanggalTransaksi);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    jarakHariInput.value = diffDays;
                }
            }

            function updateJatuhTempo() {
                const tanggalTransaksi = new Date(tanggalTransaksiInput.value);
                const jarakHari = parseInt(jarakHariInput.value, 10);

                if (tanggalTransaksi && !isNaN(jarakHari)) {
                    const jatuhTempo = new Date(tanggalTransaksi);
                    jatuhTempo.setDate(jatuhTempo.getDate() + jarakHari);
                    jatuhTempoInput.value = jatuhTempo.toISOString().split('T')[0];
                }
            }

            tanggalTransaksiInput.addEventListener('change', updateJarakHari);
            jatuhTempoInput.addEventListener('change', updateJarakHari);
            jarakHariInput.addEventListener('input', updateJatuhTempo);
            // Format number to Indonesian currency format
            function formatNumber(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }

            // Parse number from formatted input
            function parseNumber(string) {
                return parseFloat(string.replace(/\./g, '').replace(',', '.')) || 0;
            }

            // Function to update the tax calculation
            function updateTaxCalculation() {
                let dpp = parseNumber(dppInput.value); // Get the DPP value
                let totalTax = 0; // Initialize total tax
                let ppnTotal = 0; // Initialize total PPN
                let pphTotal = 0; // Initialize total PPh

                // Loop through all checked tax checkboxes
                taxCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const taxValue = parseFloat(checkbox.dataset
                            .nilai); // Get the tax value from dataset
                        const taxType = checkbox.dataset.jenis; // Get the tax type ('tambah' or 'kurang')

                        // If it's a 'tambah' tax (e.g., PPN), add to total PPN
                        if (taxType === 'tambah') {
                            ppnTotal += (dpp * taxValue / 100);
                        }
                        // If it's a 'kurang' tax (e.g., PPH), add to total PPh
                        else if (taxType === 'kurang') {
                            pphTotal += (dpp * taxValue / 100);
                        }
                    }
                });

                // Calculate the total tax (PPN ditambah dan PPH dikurang)
                totalTax = ppnTotal - pphTotal;

                // Update the PPN/PPH field (this will show the result of total tax)
                ppnValueInput.value = formatNumber((ppnTotal - pphTotal).toFixed(2));

                // Calculate total piutang (DPP + Total Tax)
                let totalPiutang = dpp + ppnTotal - pphTotal;
                totalPiutangInput.value = formatNumber(totalPiutang.toFixed(2));
            }

            // Handle DPP input format and calculation on input
            function handleDPPInput(e) {
                let value = e.target.value.replace(/\D/g, ''); // Remove non-numeric characters
                let formattedValue = value === '' ? '0' : formatNumber(parseInt(value, 10)); // Format the value
                e.target.value = formattedValue; // Update the input value
                updateTaxCalculation(); // Update tax calculation
            }

            // Add event listeners to DPP input and tax checkboxes
            dppInput.addEventListener('input', handleDPPInput);
            taxCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateTaxCalculation);
            });

            // Initial calculation to handle any preselected taxes
            updateTaxCalculation();

            var jenisTagihanSelect = document.getElementById('jenis_tagihan');
            var jumlahKaliContainer = document.getElementById('jumlah_kali_container');

            function toggleJumlahKali() {
                if (jenisTagihanSelect.value === 'berulang') {
                    jumlahKaliContainer.style.display = 'block';
                } else {
                    jumlahKaliContainer.style.display = 'none';
                }
            }

            jenisTagihanSelect.addEventListener('change', toggleJumlahKali);

            // Call the function on page load to set the initial state
            toggleJumlahKali();
});

// Mengambil elemen DPP dan Pajak
const dppInput = document.getElementById('dpp');
const pajakInput = document.getElementById('pajak');

// Function untuk menghitung selisih hari
function calculateDays() {
    const tanggalTransaksi = document.getElementById('tanggal_transaksi').value;
    const jatuhTempo = document.getElementById('jatuh_tempo').value;

    if (tanggalTransaksi && jatuhTempo) {
        const startDate = new Date(tanggalTransaksi);
        const endDate = new Date(jatuhTempo);
        const timeDiff = endDate - startDate;
        const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
        document.getElementById('jarak_hari').value = daysDiff;
    } else {
        document.getElementById('jarak_hari').value = ''; // Kosongkan jika tidak ada tanggal
    }
}

// Function untuk menghitung tanggal jatuh tempo berdasarkan input manual jumlah hari


// Function untuk memformat angka menjadi format Rupiah
function formatRupiah(angka) {
    let number_string = angka.toString().replace(/[^,\d]/g, ''),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    return 'Rp ' + rupiah + (split[1] !== undefined ? ',' + split[1] : '');
}

// Function untuk menghapus format Rupiah dari string dan mengembalikan angka
function unformatRupiah(rupiahString) {
    return parseFloat(rupiahString.replace(/[^\d,]/g, '').replace(/\./g, '').replace(',', '.')) || 0;
}

// Function untuk menghitung total berdasarkan DPP dan pajak


// Event listener untuk input DPP
dppInput.addEventListener('focus', function() {
    const unformattedValue = unformatRupiah(this.value);
    this.value = unformattedValue === 0 ? '' : unformattedValue;
});

dppInput.addEventListener('blur', function() {
    const value = unformatRupiah(this.value);
    this.value = value === 0 ? '' : formatRupiah(value);
    calculateTotal();
});

// Mencegah form submit otomatis ketika Enter ditekan
dppInput.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Mencegah submit otomatis
        calculateTotal(); // Jalankan fungsi perhitungan
    }
});

// Event listener untuk input manual pada DPP, menghitung total dan format Rupiah
dppInput.addEventListener('input', function() {
    const value = unformatRupiah(this.value);
    this.value = formatRupiah(value);
});

// Event listener untuk input Pajak, menghitung total
pajakInput.addEventListener('change', calculateTotal);

// Event listener untuk perubahan tanggal transaksi dan jatuh tempo



// nomor invoice
let nomorInvoice = 1; // Mulai dengan nomor invoice 1

function tambahBaris() {
    nomorInvoice++; // Setiap klik tambah, nomor invoice bertambah

    const container = document.getElementById('invoice-form');
    const barisBaru = document.createElement('div');
    barisBaru.className = 'flex space-x-4 mb-2';
    
    barisBaru.innerHTML = `
        <button onclick="hapusBaris(this)" class="bg-red-500 text-white px-4 py-2 rounded-full">-</button>
        <input type="text" id="nomor_invoice_${nomorInvoice}" name="nomor_invoice[]" value="INV-${nomorInvoice}" class="border border-gray-300 rounded px-4 py-2" placeholder="Masukkan Nomor Invoice">
        <input type="text" name="nama_pelanggan[]" placeholder="Nama Pelanggan" class="border border-gray-300 rounded px-4 py-2">
        <input type="date" name="jatuh_tempo[]" placeholder="Jatuh Tempo" class="border border-gray-300 rounded px-4 py-2">
        <input type="number" name="piutang_belum_dibayar[]" placeholder="Piutang Belum Dibayar" class="border border-gray-300 rounded px-4 py-2">
        <input type="number" name="denda[]" placeholder="Denda" class="border border-gray-300 rounded px-4 py-2">
        <input type="number" name="diskon[]" placeholder="Diskon" class="border border-gray-300 rounded px-4 py-2">
    `;
    
    container.appendChild(barisBaru);
}

function hapusBaris(button) {
    const baris = button.parentElement;
    baris.remove();
}

