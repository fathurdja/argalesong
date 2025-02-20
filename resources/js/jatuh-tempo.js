document.addEventListener("DOMContentLoaded", () => {
    const tahunSelect = document.getElementById("tahun");
    const bulanSelect = document.getElementById("bulan");
    const tbodyLaptop = document.getElementById("report-body-laptop");
    const tbodyMobile = document.getElementById("report-body-mobile");

    const getData = async () => {
        try {
            const response = await fetch(`/jatuh-tempo/data/${tahunSelect.value}/${bulanSelect.value}`);
            if (!response.ok) throw new Error("Gagal mengambil data");
            
            const data = await response.json();
            console.log(data);

            // Clear the table bodies before adding new rows
            tbodyLaptop.innerHTML = "";
            tbodyMobile.innerHTML = "";

            let rowsLaptop = "";
            let rowsMobile = "";

            data.forEach((pelanggan, index) => {
                // Full Table for Laptop/Desktop
                rowsLaptop += `<tr>
                                <td class="px-6 py-4 text-sm text-gray-500">${index + 1}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">${pelanggan.no_invoice}</td>
                                <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.kodepiutang}</td>
                                <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.idpelanggan}</td>
                                <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.tgltra}</td>
                                <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.tgl_jatuh_tempo}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">${pelanggan.jumlahTagihan ?? '-'}</td>
                            </tr>`;

                // Simplified Mobile View
                rowsMobile += `<div class="flex justify-between text-lg py-3 px-4">
                                <div class="flex-1 font-bold">${pelanggan.idpelanggan}</div>
                                <div class="flex-1 text-right">${pelanggan.jumlahTagihan ?? '-'}</div>
                            </div>
                            <div class="flex justify-between text-sm py-1 px-4">
                                <div class="flex-1">${pelanggan.tgl_jatuh_tempo}</div>
                                <div class="flex-1 text-right font-semibold">No Invoice: ${pelanggan.no_invoice}</div>
                            </div>
                            <div class="text-right px-4 py-2">
                                <a href="/jatuh-tempo/detail/${pelanggan.id}" class="text-blue-600">
                                    <span class="font-medium text-sm">Selengkapnya</span>
                                </a>
                            </div>`;
            });

            // Insert the new rows into the corresponding table bodies
            tbodyLaptop.innerHTML = rowsLaptop;
            tbodyMobile.innerHTML = rowsMobile;

        } catch (error) {
            console.error("Terjadi kesalahan:", error);
            tbodyLaptop.innerHTML = `<tr><td colspan="7" class="px-6 py-4 text-center text-gray-500">Gagal mengambil data</td></tr>`;
            tbodyMobile.innerHTML = `<div class="text-center py-4 text-gray-500">Gagal mengambil data</div>`;
        }
    };

    // Event listeners for year and month selection
    tahunSelect.addEventListener("change", getData);
    bulanSelect.addEventListener("change", getData);

    // Initial data fetch when page loads
    getData();
});
