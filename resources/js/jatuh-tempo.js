document.addEventListener("DOMContentLoaded", () => {
    const tahunSelect = document.getElementById("tahun");
    const bulanSelect = document.getElementById("bulan");
    const tbody = document.querySelector("tbody");

    const getData = async () => {
        try {
            const response = await fetch(`/jatuh-tempo/data/${tahunSelect.value}/${bulanSelect.value}`);
            if (!response.ok) throw new Error("Gagal mengambil data");
            
            const data = await response.json();
            console.log(data); 

            tbody.innerHTML = "";
            let rows = "";
            data.forEach(pelanggan => {
                rows += `<tr>
                            <td class="px-6 py-4 text-sm text-gray-500">${pelanggan.idpelanggan}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">${pelanggan.no_invoice}</td>
                            <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.kodepiutang}</td>
                            <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.idpelanggan}</td>
                            <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.tgltra}</td>
                            <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.tgl_jatuh_tempo}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">${pelanggan.jumlahTagihan ?? '-'}</td>
                        </tr>`;
            });

            tbody.innerHTML = rows;
        } catch (error) {
            console.error("Terjadi kesalahan:", error);
            tbody.innerHTML = `<tr><td colspan="7" class="px-6 py-4 text-center text-gray-500">Gagal mengambil data</td></tr>`;
        }
    };

    tahunSelect.addEventListener("change", getData);
    bulanSelect.addEventListener("change", getData);

    getData(); 
});