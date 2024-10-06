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
document.getElementById('jarak_hari').addEventListener('input', function() {
    const jarakHari = parseInt(this.value); // Ambil nilai input jumlah hari
    const tanggalTransaksi = document.getElementById('tanggal_transaksi').value;

    if (jarakHari && tanggalTransaksi) {
        const startDate = new Date(tanggalTransaksi);
        startDate.setDate(startDate.getDate() + jarakHari); // Tambahkan jumlah hari ke tanggal transaksi

        const jatuhTempo = startDate.toISOString().split('T')[0]; // Format menjadi YYYY-MM-DD
        document.getElementById('jatuh_tempo').value = jatuhTempo; // Set tanggal jatuh tempo
    } else {
        document.getElementById('jatuh_tempo').value = ''; // Kosongkan jika tidak ada input
    }
});

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
function calculateTotal() {
    const dpp = unformatRupiah(dppInput.value);
    const pajakPercentage = parseFloat(pajakInput.value) || 0;

    const ppnValue = (dpp * pajakPercentage) / 100;
    const totalPiutang = dpp + ppnValue;

    document.getElementById('ppn_value').value = formatRupiah(ppnValue.toFixed(2));
    document.getElementById('total_piutang').value = formatRupiah(totalPiutang.toFixed(2));
}

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
document.getElementById('tanggal_transaksi').addEventListener('change', calculateDays);
document.getElementById('jatuh_tempo').addEventListener('change', calculateDays);


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

