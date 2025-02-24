// nama komentar mengikuti nama file blade views

// formBaru
function formatNPWP(input) {
    // Hapus semua karakter yang bukan angka
    let value = input.value.replace(/\D/g, "");

    // Format string NPWP: XX.XXX.XXX.X-XXX.XXX
    let formattedValue = "";

    if (value.length > 0) {
        formattedValue += value.substring(0, 2); // XX
    }
    if (value.length > 2) {
        formattedValue += "." + value.substring(2, 5); // .XXX
    }
    if (value.length > 5) {
        formattedValue += "." + value.substring(5, 8); // .XXX
    }
    if (value.length > 8) {
        formattedValue += "." + value.substring(8, 9); // .X
    }
    if (value.length > 9) {
        formattedValue += "-" + value.substring(9, 12); // -XXX
    }
    if (value.length > 12) {
        formattedValue += "." + value.substring(12, 15); // .XXX
    }

    // Tetapkan nilai input dengan format yang baru
    input.value = formattedValue;
}



function updateKodePelanggan() {
    var tipePelanggan = document.getElementById("tipePelanggan").value;
    var tipePiutang = document.getElementById("tipePiutang").value;
    var kodePelangganInput = document.getElementById("kode_pelanggan");

    if (tipePelanggan && tipePiutang) {
        if (tipePelanggan === "perusahaan" && tipePiutang === "sewa-menyewa") {
            kodePelangganInput.value =
                "PRSH-" + Math.floor(Math.random() * 1000000);
        } else if (
            tipePelanggan === "individu" &&
            tipePiutang === "sewa-menyewa"
        ) {
            kodePelangganInput.value =
                "INDV-" + Math.floor(Math.random() * 1000000);
        } else {
            kodePelangganInput.value = "";
        }
    } else {
        kodePelangganInput.value = "";
    }
}

function toggleInput(dropdownId, inputDivId) {
    var dropdown = document.getElementById(dropdownId);
    var inputDiv = document.getElementById(inputDivId);

    if (dropdown.value === "ada") {
        inputDiv.style.display = "block";
    } else {
        inputDiv.style.display = "none";
    }
}

// On page load, check initial value of dropdowns
document.addEventListener("DOMContentLoaded", function () {
    toggleInput("npwp_option", "npwp_input");
});

// function validateForm() {
//     let messages = [];
//     const fields = {
//         'Tipe Pelanggan': document.getElementById('tipePelanggan'),
//         'Nama Pelanggan': document.getElementById('namaPelanggan'),
//         'KTP': document.getElementById('ktp'),
//         'NPWP': document.getElementById('npwp'),
//         'Alamat': document.getElementById('alamat'),
//         'E-mail': document.getElementById('email'),
//         'Whatsapp': document.getElementById('whatsapp'),
//         'Kota': document.getElementById('kota'),
//         'Kode Pos': document.getElementById('kodePos')
//     };

//     for (const [key, field] of Object.entries(fields)) {
//         if (field.value.trim() === '') {
//             messages.push(key + ' wajib diisi.');
//             field.classList.add('border-red-500');
//         } else {
//             field.classList.remove('border-red-500');
//         }
//     }

//     if (messages.length > 0) {
//         alert(messages.join('\n'));
//     } else {
//         // alert('Form sudah lengkap, data siap disimpan!');
//         // Tambahkan logika untuk submit form di sini
//     }
// }

// end formBaru
calculatePiutang()
// formEdit
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("idcompany");
    const form = document.getElementById("filterForm");

    // Kirim form secara otomatis saat input berubah
    input.addEventListener("change", function () {
        form.submit();
    });

    document
    .getElementById("tipePelanggan")
    .addEventListener("change", updateKodePelanggan);
document
    .getElementById("tipePiutang")
    .addEventListener("change", updateKodePelanggan);

    function updateRowTotal(input) {
        const row = input.closest("tr");
        const piutangValue =
            parseInt(unformatRupiah(row.querySelector(".piutang-input").value)) ||
            0;
        const diskonValue =
            parseInt(unformatRupiah(row.querySelector(".diskon-input").value)) || 0;
        const dendaValue =
            parseInt(unformatRupiah(row.querySelector(".denda-input").value)) || 0;
    
        // Update hidden values
        row.querySelector(".diskon-value").value = diskonValue;
        row.querySelector(".denda-value").value = dendaValue;
    
        const newTotal = piutangValue - diskonValue + dendaValue;
    
        row.querySelector(".total-display").value = formatRupiah(newTotal);
        row.querySelector(".total-value").value = newTotal;
    
        updateTotalPiutang();
    }
    
    function updateTotalPiutang() {
        let total = 0;
        document.querySelectorAll(".total-value").forEach((input) => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById("total-piutang").value = formatRupiah(total);
        document.querySelector('input[name="total_piutang"]').value = total;
    }
    
});

// end formEdit

// Pembayaran
function loadCustomersByCompany(companyId) {
    // Cari elemen dropdown pelanggan berdasarkan ID
    const customerDropdown = document.getElementById("customer");

    // Reset dropdown pelanggan
    customerDropdown.innerHTML =
        '<option value="">-- Pilih Pelanggan --</option>';

    if (!companyId) return;

    // Fetch customers by company ID
    fetch(`/api/customers-by-company/${companyId}`)
        .then((response) => response.json())
        .then((data) => {
            data.customers.forEach((customer) => {
                const option = document.createElement("option");
                option.value = customer.idpelanggan;
                option.textContent = `${customer.customer_name}`;
                customerDropdown.appendChild(option);
            });
        })
        .catch((error) => {
            console.error("Error loading customers:", error);
        });
}

function loadInvoicesByCustomer(customerId) {
    const invoiceContainer = document.getElementById("invoice-container");
    invoiceContainer.innerHTML = "";

    if (!customerId) return;

    fetch(`/api/invoices-by-customer/${customerId}`)
        .then((response) => response.json())
        .then((data) => {
            let totalPiutang = 0;

            data.invoices.forEach((invoice, index) => {
                totalPiutang += parseFloat(invoice.total);

                const row = `
<tr class="invoice-row" data-total="${invoice.total}">
<td class="px-3 py-2">
<input type="text" name="invoices[${index}][nomor_invoice]"
	class="invoice-input border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full"
	value="${invoice.no_invoice}" readonly>
</td>
<td class="px-3 py-2">
<input type="date" name="invoices[${index}][jatuh_tempo]"
	class="invoice-input border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full"
	value="${invoice.tgl_jatuh_tempo}" readonly>
</td>
<td class="px-3 py-2">
<input type="text"
	class="piutang-input border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full"
	value="${formatRupiah(parseFloat(invoice.tagihan))}" readonly>
<input type="hidden" name="invoices[${index}][piutang_belum_dibayar]" class="piutang-value" value="${parseFloat(
                    invoice.tagihan
                )}">
</td>
<td class="px-3 py-2">
<input type="text"
class="diskon-input border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full"
value="${formatRupiah(parseFloat(invoice.diskon))}"
onchange="updateRowTotal(this)"
onfocus="removeFormatting(this)"
onblur="applyFormatting(this)">
<input type="hidden" name="invoices[${index}][diskon]" class="diskon-value" value="${parseFloat(
                    invoice.diskon
                )}">
</td>
<td class="px-3 py-2">
<input type="text"
class="denda-input border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full"
value="${formatRupiah(parseFloat(invoice.denda))}"
onchange="updateRowTotal(this)"
onfocus="removeFormatting(this)"
onblur="applyFormatting(this)">
<input type="hidden" name="invoices[${index}][denda]" class="denda-value" value="${parseFloat(
                    invoice.denda
                )}">
</td>
<td class="px-3 py-2">
<input type="text"
	class="total-display border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full"
	value="${formatRupiah(parseFloat(invoice.total))}" readonly>
<input type="hidden" name="invoices[${index}][total]" class="total-value" value="${parseFloat(
                    invoice.total
                )}">
</td>
<td class="px-3 py-2">
<button type="button" class="delete-btn" data-total="${parseFloat(
                    invoice.total
                )}">
	<svg class="h-5 w-5 fill-red-600" xmlns="http://www.w3.org/2000/svg"
		viewBox="0 0 20 20" fill="currentColor">
		<path fill-rule="evenodd"
			d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
			clip-rule="evenodd" />
	</svg>
</button>
</td>
</tr>`;

                invoiceContainer.insertAdjacentHTML("beforeend", row);
                const deleteButton =
                    invoiceContainer.lastElementChild.querySelector(
                        ".delete-btn"
                    );
                deleteButton.addEventListener("click", function () {
                    const row = this.closest("tr");
                    row.remove();
                    reindexInvoiceInputs();
                    updateTotalPiutang();
                });
                updateTotalPiutang();
            });
        });
}

function removeFormatting(input) {
    input.value = unformatRupiah(input.value);
}

function applyFormatting(input) {
    const value = parseInt(input.value) || 0;
    input.value = formatRupiah(value);
    const row = input.closest("tr");
    row.querySelector(".piutang-value").value = value;
    updatePenaltyAndDiscount(input, input.closest("tr").rowIndex);
}


function formatRupiah(number) {
    const roundedNumber = Math.floor(number);
    return `Rp ${roundedNumber
        .toString()
        .replace(/\B(?=(\d{3})+(?!\d))/g, ".")}`;
}

function unformatRupiah(rupiahString) {
    return parseInt(rupiahString.replace(/[^0-9]/g, ""), 10) || 0;
}


// function formatRupiah(number) {
//     const roundedNumber = Math.floor(number);
//     return `Rp ${roundedNumber
//         .toString()
//         .replace(/\B(?=(\d{3})+(?!\d))/g, ".")}`;
// }

// function unformatRupiah(rupiahString) {
//     return parseInt(rupiahString.replace(/[^0-9]/g, ""), 10) || 0;
// }

function reindexInvoiceInputs() {
    const rows = document.querySelectorAll(".invoice-row");
    rows.forEach((row, index) => {
        const inputs = row.querySelectorAll('input[name^="invoices["]');
        inputs.forEach((input) => {
            const oldName = input.name;
            const fieldName = oldName.match(/\[([^\]]+)\]$/)[1];
            input.name = `invoices[${index}][${fieldName}]`;
        });
    });
}

function submitForm(action) {
    const form = document.getElementById("paymentForm");
    if (action === "proses") {
        form.action = form.dataset.prosesUrl;
    } else {
        form.action = form.dataset.storeUrl;
    }
    form.submit();
}
// End Pembayaran

// riwayatPembayaran
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("idcompany");
    const form = document.getElementById("filterForm");

    // Kirim form secara otomatis saat input berubah
    input.addEventListener("change", function () {
        form.submit();
    });

    
// Event listener for manual changes in diskon and denda
document.addEventListener("input", function (event) {
    if (
        event.target.classList.contains("diskon-input") ||
        event.target.classList.contains("denda-input")
    ) {
        updateRowTotal(event.target);
    }
});
});
// End riwayatPembayaran

// afiliasi
// var customers = @json($customers);

function updateCustomerDropdown() {
    const perusahaan = document.getElementById("perusahaan").value; // Ambil perusahaan yang dipilih
    const tipePelanggan = document.getElementById("tipePelanggan").value; // Tipe pelanggan yang dipilih
    const datalist = document.getElementById("groupList"); // Referensi elemen datalist

    // Kosongkan elemen datalist
    datalist.innerHTML = "";

    // Filter pelanggan berdasarkan perusahaan dan tipe pelanggan (jika ada)
    const filteredCustomers = customers.filter((customer) => {
        return (
            (!perusahaan || customer.idcompany === perusahaan) &&
            (!tipePelanggan || customer.idtypepelanggan === tipePelanggan)
        );
    });

    // Tambahkan opsi ke datalist
    filteredCustomers.forEach((customer) => {
        const option = document.createElement("option");
        option.value = customer.id_Pelanggan; // Value tetap id_Pelanggan
        option.textContent = `${customer.name}`; // Nama pelanggan yang tampil
        datalist.appendChild(option);
    });

    // Jika tidak ada pelanggan yang cocok, tambahkan opsi kosong
    if (filteredCustomers.length === 0) {
        const emptyOption = document.createElement("option");
        emptyOption.value = "";
        emptyOption.textContent = "-- Tidak Ada Pelanggan --";
        datalist.appendChild(emptyOption);
    }
}

// Event listener untuk memperbarui pelanggan saat perusahaan atau tipe pelanggan berubah
document
    .getElementById("perusahaan")
    .addEventListener("change", updateCustomerDropdown);
document
    .getElementById("tipePelanggan")
    .addEventListener("change", updateCustomerDropdown);

// Panggil fungsi ini saat halaman dimuat untuk inisialisasi awal
document.addEventListener("DOMContentLoaded", updateCustomerDropdown);

// function formatRupiah(value) {
//     return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
// }

function formatDPP(input) {
    let value = input.value.replace(/\./g, ""); // Remove existing dots for reformatting
    if (!isNaN(value) && value !== "") {
        input.value = formatRupiah(value); // Apply Rupiah format
    } else {
        input.value = ""; // Clear if not a valid number
    }
    calculatePiutang(); // Recalculate totals
}

function calculatePiutang() {
    const dppInput =
        parseFloat(document.getElementById("dpp").value.replace(/\./g, "")) ||
        0;
    const ppnRate = parseFloat(document.getElementById("ppn_type").value) || 0; // Get PPN rate percentage
    const pphRate = parseFloat(document.getElementById("tarif").value) || 0; // Get PPh rate percentage

    // Calculate PPN and PPh values
    const ppnValue = (dppInput * ppnRate) / 100;
    const pphValue = (dppInput * pphRate) / 100;

    // Set formatted values for PPN and PPh
    document.getElementById("ppn_value").value = formatRupiah(
        ppnValue.toFixed(0)
    );
    document.getElementById("pph_value").value = formatRupiah(
        pphValue.toFixed(0)
    );

    // Calculate total piutang
    const totalPiutang = dppInput + ppnValue - pphValue;
    document.getElementById("total_piutang").value = formatRupiah(
        totalPiutang.toFixed(0)
    );
}

// Event listeners to trigger calculation when PPN or PPh types change
document
    .getElementById("ppn_type")
    .addEventListener("change", calculatePiutang());
document.getElementById("tarif").addEventListener("change", calculatePiutang());
// Show or hide 'jumlah_kali' input based on 'jenis_tagihan' selection
document
    .getElementById("jenis_tagihan")
    .addEventListener("change", function () {
        const jumlahKaliContainer = document.getElementById(
            "jumlah_kali_container"
        );
        jumlahKaliContainer.style.display =
            this.value === "berulang" ? "block" : "none";
    });

function syncCustomerId(input) {
    const datalist = document.getElementById("groupList"); // Referensi elemen datalist
    const hiddenInput = document.getElementById("id_Pelanggan"); // Input tersembunyi untuk id_Pelanggan
    const selectedOption = Array.from(datalist.options).find(
        (option) => option.textContent.trim() === input.value.trim()
    );

    // Jika nama pelanggan ditemukan di datalist, sinkronkan id_Pelanggan
    if (selectedOption) {
        hiddenInput.value = selectedOption.getAttribute("data-id"); // Ambil id_Pelanggan dari atribut data-id
        input.value = selectedOption.textContent.trim(); // Set input value ke nama pelanggan
    } else {
        hiddenInput.value = ""; // Reset jika input tidak cocok
    }
}
// End afiliasi

// riwayatPiutang
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("idcompany");
    const form = document.getElementById("filterForm");

    // Kirim form secara otomatis saat input berubah
    input.addEventListener("change", function () {
        form.submit();
    });
});
// End riwayatPiutang

// Bulanan
document.addEventListener("DOMContentLoaded", function () {
    // Format Rupiah
    function formatRupiah(angka) {
        if (angka === undefined || angka === null || isNaN(angka)) {
            return "Rp. 0"; // Atau nilai default lainnya jika angka null atau undefined
        }

        // Pastikan angka adalah integer, hilangkan desimal jika ada
        angka = Math.floor(angka);

        let number_string = angka.toString(),
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            let separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        return "Rp. " + rupiah;
    }

    // Function to fetch data based on selected month and year
    function fetchData(month, year) {
        fetch(`/get-monthly-report?month=${month}&year=${year}`)
            .then((response) => response.json())
            .then((data) => {
                console.log(data);

                const tbody = document.getElementById("report-body");
                tbody.innerHTML = ""; // Clear current data

                let totalPiutang = 0; // Variable to calculate total receivables
                let totalPembayaran = 0; // Variable to calculate total payments
                let totalSaldoPiutang = 0; // Variable to calculate total outstanding balance

                if (data.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="8" class="text-center py-4 text-gray-500">Data tidak ditemukan</td></tr>`;
                } else {
                    // Process all data without grouping by customer
                    data.forEach((item, index) => {
                        let nominal = parseFloat(item.total_piutang) || 0;
                        let pembayaran = parseFloat(item.total_pembayaran) || 0;

                        // Calculate saldo piutang (outstanding balance)

                        totalPiutang += nominal;
                        totalPembayaran += pembayaran;
                        totalSaldoPiutang += item.saldo_piutang;

                        tbody.innerHTML += `
<tr>
	<td class="px-6 py-4 whitespace-nowrap">${index + 1}</td>
	<td class="px-6 py-4 whitespace-nowrap">${item.id_pelanggan}</td>
	<td class="px-6 py-4 whitespace-nowrap">${item.pelanggan}</td>
	<td class="px-6 py-4 whitespace-nowrap">${item.jatuh_tempo}</td>
	<td class="px-6 py-4 whitespace-nowrap text-right">${formatRupiah(
        item.total_piutang
    )}</td>
	<td class="px-6 py-4 whitespace-nowrap text-right">${formatRupiah(
        pembayaran
    )}</td>
  <td class="px-6 py-4 whitespace-nowrap text-right">${formatRupiah(
      item.saldo_piutang < 10 ? 0 : item.saldo_piutang
  )}</td>

</tr>
`;
                    });

                    // Add the last row for total balance
                    tbody.innerHTML += `
			<tr>
				<td colspan="6" class="px-6 py-4 whitespace-nowrap text-right font-bold">Total</td>
				<td class="px-6 py-4 whitespace-nowrap text-right font-bold">${formatRupiah(
                    totalSaldoPiutang
                )}</td>
			</tr>
		`;
                }
            })
            .catch((error) => {
                console.error("Error fetching data:", error);
                const tbody = document.getElementById("report-body");
                tbody.innerHTML = `<tr><td colspan="8" class="text-center py-4 text-red-500">Terjadi kesalahan dalam mengambil data</td></tr>`;
            });
    }

    // Event listeners for month selection
    const today = new Date();
    const currentMonth = today.getMonth() + 1; // JavaScript month is 0-indexed, so add 1
    const currentYear = today.getFullYear();

    // Set the current year in the dropdown
    document.getElementById("year").value = currentYear;

    // Function to highlight the selected month
    function highlightCurrentMonth(month) {
        document
            .querySelectorAll('[id^="month-"]')
            .forEach((el) =>
                el.classList.remove(
                    "border-b-4",
                    "border-indigo-600",
                    "font-bold"
                )
            );
        document
            .getElementById(`month-${month}`)
            .classList.add("border-b-4", "border-indigo-600", "font-bold");
    }

    // Fetch data based on current month and year
    fetchData(currentMonth, currentYear);
    highlightCurrentMonth(currentMonth);

    // Event listeners for month selection
    document.querySelectorAll('[id^="month-"]').forEach((element) => {
        element.addEventListener("click", function () {
            const month = this.id.split("-")[1];
            const year = document.getElementById("year").value;

            // Fetch and display data
            fetchData(month, year);

            // Highlight the selected month
            highlightCurrentMonth(month);
        });
    });

    // Print button functionality
    document.getElementById("print-btn").addEventListener("click", function () {
        window.print();
    });
});
// End Bulanan



// custom mbul
document.addEventListener("DOMContentLoaded",  () => {
    
})